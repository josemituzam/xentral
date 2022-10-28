<?php

namespace App\Http\Controllers\Landlord\RequestDomain;


use App\Models\Core\Tenant;
use Illuminate\Http\Request;
use App\Models\Core\Auth\Tenant\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Api\ApiCloudfareController;
use App\Http\Utils\Helpers;
use App\Models\Core\Api\ApiCloudfare;
use App\Models\Landlord\RequestDomain\DomainService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Domain;
use App\Models\Landlord\RequestDomain\RequestDomain as RequestDomainLandlord;
use Database\Seeders\tenant\DatabaseSeeder;

class RequestDomainController extends Controller
{
    /**
     * Retorna los registros desde la base de datos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasrole('Root')) {

            if (\Request::exists('all')) {
                // return $this->service->with(['persons'])->select('id', 'name')->get();
            }
            $helpers = new Helpers();
            $columns = array();
            $param = array();
            $type = null;

            if (!empty(\Request::exists('created_at'))) {

                //Filtros para campos de auditoría con tipo de dato timestap;
                $columns = array(0 => 'created_at');
                $param = array(0 => '=');
                $type = 1;
            } else {
                //Filtros normales
                $columns = array(0 => 'is_active', 1 => 'is_approved');
                $param = array(0 => '=', 1 => '=');
                $type = 0;
            }
            $requestDomains = RequestDomainLandlord::with(['service'])->where('deleted_at', '=', null);

            $Filtred = $helpers->filter($requestDomains, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('fullname', 'LIKE', "%{$request->q}%")
                            ->orWhere('email', 'LIKE', "%{$request->q}%")
                            ->orWhere('domain_name', 'LIKE', "%{$request->q}%");
                    });
                })->paginate(
                    request(
                        'perPage',
                        \Request::get('perPage') ?? 1
                    )
                );

            $sortedResult = $Filtred->getCollection()->sortBy(request(
                'sortBy',
                \Request::get('sortBy') ?? 'created_at'
            ))->values();

            $Filtred->setCollection($sortedResult);

            return $Filtred;
        }
    }

    /*
     * Corre las migraciones de lso tenant
     */

    public function runMigrationsSeeders($tenant)
    {
        Artisan::call(
            'tenants:seed',
            [
                '--class' => DatabaseSeeder::class,
                '--tenants' => [$tenant['id']]
            ]
        );
    }

    /**
     * Muestra un registro en específico.
     */
    public function edit($id)
    {
        return RequestDomainLandlord::where('id', $id)
            ->with(['service'])
            ->firstOrFail();
    }


    /**
     * Guarda los registro de los inquilinos y corre las migracionesss
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = RequestDomainLandlord::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['fullname'] = $request->fullname;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['type'] = 'Admin';
        $input['company_name'] = $request->company_name;
        $request->domain_name = strtolower(substr(str_replace(' ', '', $request->domain_name), 0, 50));
        $input['domain_name'] = $request->domain_name;
        $objDomainService = $request->maxUserService;

        $objRequestDomain = RequestDomainLandlord::create($input);
        // Aqui se crea el servicio para el dominio específico
        for ($i = 0; $i < count($objDomainService); $i++) {
            if ($objDomainService[$i]["service_id"] == null) {
                return response()->json(['errors' => [
                    'error' => ['Los campos de dejar de hacer no pueden quedar vacíos.'],
                ]], 422);
            }
            $objDataLet = [
                'request_domain_id' => $objRequestDomain->id,
                "service_id" =>  $objDomainService[$i]["service_id"],
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_users' =>  $objDomainService[$i]["max_users"]
            ];
            DomainService::create($objDataLet);
        }

        // Se envia la url del nuevo inquilino creado
        return  response()->json([
            'obj' =>  $objRequestDomain
        ], 200);
    }


    protected function createTenant($objRequestDomain)
    {
        //Si comento el ID se crea el tenant con uuid
        $objTenant = Tenant::create([
            //'id' => $request->domain_name,
            'tenancy_db_name' => config('tenancy.database.prefix') . $objRequestDomain->domain_name . config('tenancy.database.suffix'),
            'tenancy_db_username' => 'us_' . $objRequestDomain->domain_name . config('tenancy.database.suffix'),
            'tenancy_db_password' => bcrypt($objRequestDomain->domain_name . $this->random_str_generator(16)),
        ]);

        $this->runMigrateTenant($objTenant, $objRequestDomain);

        Domain::create([
            // 'domain' => $request->domain_name . '.' . $request->getHost(),
            'domain' => $objRequestDomain->domain_name . $objRequestDomain->domain,
            //'domain' => $request->domain_name . '.' . $request->getHttpHost(),
            'tenant_id' => $objTenant->id,
        ]);

        $objApi = ApiCloudfare::where('long_code', 'ROOT')->where('type', 'Zone')->first();
        $methods = new ApiCloudfareController();
        //$methods->createSubDomain($objRequestDomain, $objApi);
        return $objTenant;
    }


    protected function runMigrateTenant($objTenant, $objRequestDomain)
    {
        tenancy()->initialize($objTenant);

        $this->runMigrationsSeeders($objTenant);

        User::create([
            'email' => $objRequestDomain->email,
            'password' =>  $objRequestDomain->password,
        ]);

        tenancy()->end();
    }

    /*
     * Se activa o desactiva un registro en específico
     */

    public function activeRecord(Request $request, $id)
    {
        $obj = RequestDomainLandlord::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }

    /*
     * Se aprueba o no un inquilino creados
     */

    public function approvedRecord(Request $request, $id)
    {
        $obj = RequestDomainLandlord::find($id);
        $obj->is_approved  = $request->is_approved;
        $objTenant = $this->createTenant($obj);
        $urlTenant =  "http://" . $obj->domain_name . config('app.url_frontend_tenant');
        $obj->tenant_id  = $objTenant->id;
        $obj->url  = $urlTenant;
        $obj->save();

        return  response()->json([
            'url_tenant' =>   $obj->url,
            'url_parse' =>  parse_url($obj->url)
        ], 200);
    }

    /*
     * Crea un password random para el nuevo usuario de la base de datos
     */

    public function random_str_generator($len_of_gen_str)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $var_size = strlen($chars);
        for ($x = 0; $x < $len_of_gen_str; $x++) {
            $random_str = $chars[rand(0, $var_size - 1)];
            //echo $random_str;
        }
        return $random_str;
    }
}

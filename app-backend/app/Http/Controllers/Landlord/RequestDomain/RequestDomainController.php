<?php

namespace App\Http\Controllers\Landlord\RequestDomain;


use App\Models\Core\Tenant;
use Illuminate\Http\Request;
use App\Models\Core\Auth\Tenant\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Api\ApiCloudfareController;
use App\Http\Utils\Helpers;
use App\Models\Core\Api\ApiCloudfare;
use App\Models\Core\Api\ApiR2;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Domain;
use App\Models\Landlord\RequestDomain\RequestDomain;
use App\Models\Landlord\RequestDomain\DomainService as DomainServiceLandlord;
use App\Models\Tenant\Service\DomainService as DomainServiceTenant;
use App\Models\Landlord\Service\Service  as ServiceLandlord;
use App\Models\Tenant\Api\ApiR2 as ApiR2Tenant;
use App\Models\Tenant\Service\Service as ServiceTenant;
use App\Models\Tenant\Setting\Company\Company;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Database\Seeders\tenant\DatabaseSeeder;
use Illuminate\Support\Facades\File;

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
            $requestDomains = RequestDomain::with(['service' => function ($query) {
                $query->where('domain_services.deleted_at', '=', null);
            }])->where('deleted_at', '=', null);

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
        return RequestDomain::where('id', $id)
            ->with([
                'domainService' => function ($query) {
                    $query->with([
                        'service',
                    ]);
                },

                'service',
            ])
            ->firstOrFail();
    }


    public function runStorageTenant()
    {
        $path = storage_path('/app/public');
        File::makeDirectory($path, $mode = 0777, true, true);
    }


    public function putDomainService(Request $request, $id)
    {
        DomainServiceLandlord::where('request_domain_id', $id)->delete();
        $objDomainService = $request->maxContractService;
        for ($i = 0; $i < count($objDomainService); $i++) {
            if ($objDomainService[$i]["service_id"] == null) {
                return response()->json(['errors' => [
                    'error' => ['Los campos de dejar de hacer no pueden quedar vacíos.'],
                ]], 422);
            }
            $objDataLet = [
                'request_domain_id' =>  $id,
                "service_id" =>  $objDomainService[$i]["service_id"],
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_contracts' =>  $objDomainService[$i]["max_contracts"]
            ];
            DomainServiceLandlord::create($objDataLet);
        }

        $objRequestDomain = RequestDomain::where('id', $id)->first();

        $objTenant = Tenant::where('id', $objRequestDomain->tenant_id)->first();

        // Tomo el servicio
        $objDomainService = DomainServiceLandlord::where('request_domain_id', '=', $objRequestDomain->id)->get();
        foreach ($objDomainService as $s) :
            $serviceId[] = $s->service_id;
        endforeach;

        $objService = ServiceLandlord::whereIn('id', $serviceId)->get();

        tenancy()->initialize($objTenant);

        ServiceTenant::truncate();
        DomainServiceTenant::truncate();

        for ($i = 0; $i < $objService->count(); $i++) {
            $objServiceTenant =  ServiceTenant::create([
                'name' => $objService[$i]->name,
                "photo" => $objService[$i]->photo,
                "url" => $objService[$i]->url,
                "icon" => $objService[$i]->icon,
                'description' => $objService[$i]->description
            ]);

            DomainServiceTenant::create([
                'tenant_id' => $objTenant['id'],
                "service_id" =>  $objServiceTenant->id,
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_contracts' =>  $objDomainService[$i]["max_contracts"],
            ]);
        }
        tenancy()->end();


        return response()->json(['success' => [
            'message' => ['Servicios actualizados'],
        ]], 200);
    }

    public function editDomainService($id)
    {
        $objService = ServiceLandlord::all();
        $objEnd = [];
        $objId = array();
        $objId2 = array();
        foreach ($objService as $item) :
            $objId[] = $item->id;
        endforeach;
        $objDomainServiceIn = DomainServiceLandlord::select('services.name as name', 'services.id as id', 'domain_services.max_contracts as max_contracts')
            ->join('services', 'services.id', '=', 'domain_services.service_id')
            ->whereIn('services.id', $objId)->where('request_domain_id', $id)->get();
        foreach ($objDomainServiceIn as $item) :
            $objId2[] = $item->id;
        endforeach;
        $objDomainServiceNotIn = ServiceLandlord::whereNotIn('services.id', $objId2)->get();
        for ($i = 0; $i < $objDomainServiceIn->count(); $i++) {
            $obj = [
                'id' => $objDomainServiceIn[$i]->id,
                'name' =>  $objDomainServiceIn[$i]->name,
                'checked' => true,
                'max_contracts' => $objDomainServiceIn[$i]->max_contracts,

            ];
            array_push($objEnd, $obj);
        }
        for ($i = 0; $i < $objDomainServiceNotIn->count(); $i++) {
            $obj =  [
                'id' => $objDomainServiceNotIn[$i]->id,
                'name' =>  $objDomainServiceNotIn[$i]->name,
                'checked' => false,
                'max_contracts' => 0
            ];
            array_push($objEnd, $obj);
        }
        return  [
            'obj' =>  $objEnd
        ];
    }



    /**
     * Guarda los registro de los inquilinos y corre las migracionesss
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validator = RequestDomain::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['fullname'] = $request->fullname;
        $input['email'] = $request->email;
        $input['country'] = $request->country;
        $input['password'] = Hash::make($request->password);
        $input['type'] = 'Admin';
        $input['company_name'] = $request->company_name;
        $request->domain_name = strtolower(substr(str_replace(' ', '', $request->domain_name), 0, 50));
        $input['domain_name'] = $request->domain_name;
        $objDomainService = $request->maxContractService;

        $objRequestDomain = RequestDomain::create($input);
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
                'max_contracts' =>  $objDomainService[$i]["max_contracts"]
            ];
            DomainServiceLandlord::create($objDataLet);
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
            'domain' => $objRequestDomain->domain_name . env('CENTRAL_DOMAIN'),
            //'domain' => $objRequestDomain->domain_name . $objRequestDomain->domain,
            //'domain' => $request->domain_name . '.' . $request->getHttpHost(),
            'tenant_id' => $objTenant->id,
        ]);

        $varEnv = env('APP_MODE');
        $objApi = ApiCloudfare::where('short_code', '=', $varEnv)->get();
        $methods = new ApiCloudfareController();
        foreach ($objApi as $item) {
            // $methods->createSubDomain($objRequestDomain->domain_name, $item);
        }
        return $objTenant;
    }

    protected function createBucketS3($objRequestDomain)
    {
        $objR2 = ApiR2::where('short_code', '=', 'PRO')->first();
        /*$bucket_name = $objRequestDomain->domain_name;
        $account_id         = $objR2->account_id;
        $access_key_id      = $objR2->access_key_id;
        $access_key_secret  = $objR2->access_key_secret;
        $credentials = new Credentials($access_key_id, $access_key_secret);
        $key_image_name =  $objR2->key_image_name;
        $key_file_name = $objR2->key_file_name;

        $options = [
            'region' => 'auto',
            'endpoint' => "https://$account_id.r2.cloudflarestorage.com",
            'version' => 'latest',
            'credentials' => $credentials
        ];
        $s3_client = new S3Client($options);

        $s3_client->createBucket(array(
            'Bucket' => $bucket_name,
        ));
        $s3_client->waitUntil('BucketExists', array('Bucket' => $bucket_name)); */

      /*  $s3_client->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $key_image_name,
        ));

        $s3_client->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $key_file_name,
        )); */

        return $objR2;
    }


    protected function runMigrateTenant($objTenant, $objRequestDomain)
    {
        // Tomo el servicio
        $objDomainService = DomainServiceLandlord::where('request_domain_id', '=', $objRequestDomain->id)->get();
        foreach ($objDomainService as $s) :
            $serviceId[] = $s->service_id;
        endforeach;
        $objService = ServiceLandlord::whereIn('id', $serviceId)->get();
        $objR2 = $this->createBucketS3($objRequestDomain);

        tenancy()->initialize($objTenant);

        $this->runMigrationsSeeders($objTenant);

        //$this->runStorageTenant();

        User::create([
            'email' => $objRequestDomain->email,
            'password' =>  $objRequestDomain->password,
        ]);

        for ($i = 0; $i < $objService->count(); $i++) {
            $objServiceTenant =  ServiceTenant::create([
                'name' => $objService[$i]->name,
                "photo" => $objService[$i]->photo,
                "url" => $objService[$i]->url,
                "icon" => $objService[$i]->icon,
                'description' => $objService[$i]->description
            ]);

            DomainServiceTenant::create([
                'tenant_id' => $objTenant['id'],
                "service_id" =>  $objServiceTenant->id,
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_contracts' =>  $objDomainService[$i]["max_contracts"],
            ]);
        }

        Company::create([
            'name' => $objRequestDomain->company_name,
            "country" => $objRequestDomain->country,
        ]);

        ApiR2Tenant::create([
            'bucket_name'  => $objRequestDomain->domain_name,
            'account_id' => $objR2->account_id,
            'access_key_id' => $objR2->access_key_id,
            'access_key_secret' => $objR2->access_key_secret,
            'key_image_name' => $objR2->key_image_name,
            'key_file_name' => $objR2->key_file_name,
            'short_code' =>  $objR2->short_code,
            'long_code' =>  $objR2->long_code,
        ]);

        tenancy()->end();
    }

    /*
     * Se activa o desactiva un registro en específico
     */

    public function activeRecord(Request $request, $id)
    {
        $obj = RequestDomain::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }

    /*
     * Se aprueba o no un inquilino creados
     */

    public function approvedRecord(Request $request, $id)
    {
        $obj = RequestDomain::find($id);

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

<?php

namespace App\Http\Controllers\Landlord\RequestDomain;

use App\Models\Core\Tenant;
use Illuminate\Http\Request;
use App\Models\Core\Auth\Tenant\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Domain;
use App\Models\Landlord\RequestDomain\RequestDomain as RequestDomainLandlord;
use Database\Seeders\Tenant\DatabaseSeeder;

class RequestDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

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
     * Store a newly created resource in storage.
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

        $input['firstname'] = $request->firstname;
        $input['lastname'] = $request->lastname;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['type'] = 'Admin';
        $input['is_approved'] = 1;
        $request->domain_name = strtolower(substr(str_replace(' ', '', $request->domain_name), 0, 50));

        //Si comento el ID se crea el tenant con uuid
        $tenant = Tenant::create([
            //'id' => $request->domain_name,
            'tenancy_db_name' => config('tenancy.database.prefix') . $request->domain_name . config('tenancy.database.suffix'),
            'tenancy_db_username' => 'us_' . $request->domain_name . config('tenancy.database.suffix'),
            'tenancy_db_password' => bcrypt($request->domain_name . $this->random_str_generator(16)),
        ]);
        $input['tenant_id'] = $tenant->id;
        $input['domain_name'] = $request->domain_name;

        Domain::create([
            'domain' => $request->domain_name . '.' . $request->getHost(),
            //'domain' => $request->domain_name . '.' . $request->getHttpHost(),
            'tenant_id' => $tenant->id,
        ]);

        $objRequestDomainLandlord = RequestDomainLandlord::create($input);

        if (auth('apilandlord')->user()->hasrole('Super Admin')) {
            $user = User::where('id', '=', auth('apilandlord')->user()->id)->first();
        }

        tenancy()->initialize($tenant);

        $this->runMigrationsSeeders($tenant);

        return response()->json([
            $objRequestDomainLandlord
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestDomain  $requestDomain
     * @return \Illuminate\Http\Response
     */
    public function show(RequestDomainLandlord $requestDomain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestDomain  $requestDomain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /* public function edit(RequestDomain $requestDomain)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestDomain  $requestDomain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestDomain  $requestDomain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }


    public function random_str_generator($len_of_gen_str)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $var_size = strlen($chars);
        echo "Random string =";
        for ($x = 0; $x < $len_of_gen_str; $x++) {
            $random_str = $chars[rand(0, $var_size - 1)];
            //echo $random_str;
        }
        return $random_str;
    }
}

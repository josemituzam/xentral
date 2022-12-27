<?php

namespace App\Http\Controllers\Tenant\Setting\UserDetail;

use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Core\Auth\Tenant\User;
use App\Models\Core\Auth\Role;
use App\Models\Tenant\Setting\Company\Sale;
use App\Models\Tenant\Setting\UserDetail\UserDetail;
use App\Models\Tenant\Setting\UserDetail\UserSale;
use App\Models\Tenant\Setting\ZoneSale\ZoneSale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{

    public function getUserSales($userId)
    {
        $obj = UserSale::with('getSale.getBranch')->where('user_id', '=', $userId)->get();

        return response()->json([
            'obj' => $obj,
        ]);
    }

    public function storeUserSale(Request $request)
    {
        $objCount =  UserSale::with('getSale.getBranch')
            ->where('user_id', '=', $request->user_id)
            ->where('sale_id', '=', $request->sale_id)
            ->count();

        if ($objCount > 0) {
            return response()->json([
                'msg' => 'Ya se ha asignado este punto de venta'
            ], 422);
        }

        $input['user_id'] = $request->user_id;
        $input['sale_id'] = $request->sale_id;
        $obj = UserSale::create($input);
        return response()->json([
            'obj'  => $obj
        ]);
    }

    public function getZoneSales()
    {
        $obj = ZoneSale::where('deleted_at', '=', null)->where('is_active', '=', 1)->get();

        return response()->json([
            'obj' => $obj,
        ]);
    }
    public function getSales()
    {
        $obj = Sale::with('getBranch')->where('deleted_at', '=', null)->where('is_active', '=', 1)->get();

        return response()->json([
            'obj' => $obj,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (auth('apiTenant')->user()->hasrole('Root')) {
            if (\Request::exists('all')) {
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
                $columns = array(0 => 'is_active');
                $param = array(0 => '=');
                $type = 0;
            }
            $service = UserDetail::with('getUser')->where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name', 'LIKE', "%{$request->q}%");
                    });
                })->orderBy('created_at', 'DESC')->paginate(
                    request(
                        'perPage',
                        \Request::get('perPage') ?? 1
                    )
                );

            $sortedResult = $Filtred->getCollection()->sortByDesc(request(
                'sortBy',
                \Request::get('sortBy') ?? 'created_at'
            ))->values();

            $Filtred->setCollection($sortedResult);
            return $Filtred;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = UserDetail::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['firstname'] = $request->firstname;
        $input['lastname'] = $request->lastname;
        $input['fullname'] = $request->firstname . ' ' . $request->lastname;
        $input['type_identification'] = $request->type_identification;
        $input['identification'] = $request->identification;
        $input['birthday_at'] = $request->birthday_at;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        //$input['email'] = $request->email;
        $input['cant_extra_time'] = $request->cant_extra_time;
        $input['day_extra_time'] = $request->day_extra_time;
        $input['zone_sale_id'] = $request->zone_sale_id;
        $input['description'] = $request->description;
        $objUser = User::create([
            'email' => $request->email,
            'password' =>  null,
        ]);
        $objGeneral = Role::findByName('Supervisor', 'apiTenant');
        $objUser->assignRole($objGeneral);
        $input['user_id'] = $objUser->id;
        $obj = UserDetail::create($input);
        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZoneSale  $zoneSale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = UserDetail::with('getUser')->find($id);

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = UserDetail::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $obj = UserDetail::find($id);
        $obj->firstname = $request->firstname;
        $obj->lastname = $request->lastname;
        $obj->fullname = $request->firstname . ' ' . $request->lastname;
        $obj->type_identification = $request->type_identification;
        $obj->identification = $request->identification;
        $obj->birthday_at = $request->birthday_at;
        $obj->phone  = $request->phone;
        $obj->address = $request->address;
        User::where('id', $obj->getUser->id)->update([
            'email' => $request->email,
        ]);
        $obj->cant_extra_time = $request->cant_extra_time;
        $obj->day_extra_time = $request->day_extra_time;
        $obj->zone_sale_id = $request->zone_sale_id;
        $obj->description = $request->description;
        $obj->save();
        return response()->json([
            'obj'  => $obj
        ]);
    }


    public function activeRecord(Request $request, $id)
    {
        $obj = UserDetail::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspPlan  $ispPlan
     * @return \Illuminate\Http\Response
     */
    public function destroyUserSales($id)
    {
        UserSale::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $objFound = UserDetail::find($id);
        UserDetail::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

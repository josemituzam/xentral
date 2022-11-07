<?php

namespace App\Http\Controllers\Tenant\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Customer\IspCustomer;
use App\Http\Utils\Helpers;

class IspCustomerController extends Controller
{
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
            $service = IspCustomer::where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name', 'LIKE', "%{$request->q}%")
                            ->orWhere('description', 'LIKE', "%{$request->q}%");
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function activeRecord(Request $request, $id)
    {
        $obj = IspCustomer::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validator = IspCustomer::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }
        $input['address'] = $request->address;
        $input['email'] = $request->email;
        $input['firstname'] = $request->firstname;
        $input['lastname'] = $request->lastname;
        $input['fullname'] = $request->firstname . ' ' . $request->lastname;
        $input['firstname_representative'] = $request->firstname_representative;
        $input['identification'] = $request->identification;
        $input['is_accounting'] = $request->is_accounting;
        $input['is_bond'] = $request->is_bond;
        $input['is_disability'] = $request->is_disability;
        $input['is_old'] = $request->is_old;
        $input['lastname_representative'] = $request->lastname_representative;
        $input['fullname_representative'] = $request->firstname_representative . ' ' . $request->lastname_representative;
        $input['name_company'] = $request->name_company;
        $input['phone_fixed'] = $request->phone_fixed;
        $input['phone_movil'] = json_encode($request->phone_movil);
        $input['phone_representative'] =  json_encode($request->phone_representative);;
        $input['started_at'] = $request->started_at;
        $input['type_gender'] = $request->type_gender;
        $input['type_identification'] = $request->type_identification;
        $input['type_number'] = $request->type_number;
        $input['type_people'] = $request->type_people;
        $obj = IspCustomer::create($input);

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IspCustomer  $ispCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(IspCustomer $ispCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspCustomer  $ispCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(IspCustomer $ispCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspCustomer  $ispCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IspCustomer $ispCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspCustomer  $ispCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(IspCustomer $ispCustomer)
    {
        //
    }
}

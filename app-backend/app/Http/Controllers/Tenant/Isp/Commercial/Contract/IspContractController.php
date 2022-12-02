<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Contract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Isp\Commercial\Contract\IspContract;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Isp\Commercial\Contract\IspAnotherProvider;
use App\Models\Tenant\Isp\Commercial\Contract\IspContractPlan;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;

use App\Models\Tenant\Isp\Commercial\Plan\IspPlan;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use App\Models\Tenant\Traits\Payment\Payment;
use App\Models\Tenant\Traits\Template\TemplateContract;
use Illuminate\Support\Facades\DB;

class IspContractController extends Controller
{
    public function getTemplateContract()
    {
        $obj = TemplateContract::where('is_active', 1)->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getSector()
    {
        $obj = IspSector::join('isp_locations', 'isp_locations.id', '=', 'isp_sectors.location_id')
            ->select(
                DB::raw('CONCAT(isp_sectors.sector," | ",isp_locations.location,", ", isp_locations.city  ,", ", isp_locations.state) as sector_name'),
                'isp_sectors.id as sector_uuid',
                'isp_sectors.latitude as latitude',
                'isp_sectors.longitude as longitude'
            )->get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getAnotherProvider()
    {
        $obj = IspAnotherProvider::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getPayment()
    {
        $obj = Payment::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getPlan($last_mile_id)
    {
        $obj = IspPlan::with('plandetail', 'plandetail.minimunpermanence')->where('last_mile_id', $last_mile_id)->get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getCustomer(Request $request)
    {
        //return "holaaaa";
        $helpers = new Helpers();
        $columns = array();
        $param = array();
        $type = null;

        $searchValues = preg_split('/\s+/', $request->q, -1, PREG_SPLIT_NO_EMPTY);

        $service = IspCustomer::where('deleted_at', '=', null);
        //  str_replace(' ', '', $request->q);
        $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
            ->where(function ($query) use ($request, $searchValues) {
                return $query->when($request->filled('q'), function ($query) use ($request, $searchValues) {
                    foreach ($searchValues as $value) {
                        return $query->Where('fullname', 'LIKE', "%{$value}%")
                            ->orWhere('identification', 'LIKE', "%{$value}%");
                    }
                });
            })->get();

        return $Filtred;
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
                $columns = array(0 => 'is_active', 1 => 'type_people');
                $param = array(0 => '=', 1 => '=');
                $type = 0;
            }
            $service = IspContract::where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name_company', 'LIKE', "%{$request->q}%")
                            ->orWhere('fullname', 'LIKE', "%{$request->q}%")
                            ->orWhere('identification', 'LIKE', "%{$request->q}%")
                            ->orWhere('address', 'LIKE', "%{$request->q}%");
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = IspContract::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }
        $objCp = [
            'plan_id' => $request->plan_id,
            'installation_cost' => $request->installation_cost,
            'month_cost' => $request->month_cost,
            'minimun_permanence_id'  => $request->minimun_permanence_id,
            'permanence_cost' => $request->permanence_cost,
            'is_permanence_cost' => $request->is_permanence_cost,
            'compartition' => $request->compartition,
        ];
        $dataCp = IspContractPlan::create($objCp);

        $input['emission_at'] = $request->emission_at;
        $input['contract_plan_id'] =  $dataCp->id;
        $input['break_at'] = $request->break_at;
        $input['customer_id'] = $request->customer_id;
        $input['username'] = $request->username;
        $input['sector_id'] = $request->sector_id;
        $input['address_contract'] = $request->address_contract;
        $input['contract_version_id'] = $request->contract_version_id;
        $input['address_contract'] = $request->address_contract;
        $input['another_provider_id'] = $request->another_provider_id;
        $input['payment_id'] = $request->payment_id;
        $input['adviser_id'] = $request->adviser_id;
        $input['status_id'] = $request->status_id;
        $input['is_reconnection_cost'] = $request->is_reconnection_cost;
        $input['reconnection_cost'] = $request->reconnection_cost;
        $input['is_from_another_provider'] = $request->is_from_another_provider;
        $input['is_pay_to_invoice'] = $request->is_pay_to_invoice;
        $input['is_apply_arcotel'] = $request->is_apply_arcotel;
        $input['is_not_cut_for_debt'] = $request->is_not_cut_for_debt;
        $input['is_not_generate_invoice_service'] = $request->is_not_generate_invoice_service;
        $obj = IspContract::create($input);
        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function show(IspContract $ispContract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = IspContract::with('ispcontractplan', 'ispcontractplan.plan', 'ispsector', 'ispcustomer')->find($id);
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IspContract $ispContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(IspContract $ispContract)
    {
        //
    }
}

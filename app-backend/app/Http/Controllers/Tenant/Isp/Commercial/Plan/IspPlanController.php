<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Plan;

use App\Models\Tenant\Isp\Commercial\Plan\IspPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Isp\Commercial\Plan\IspPlanDetail;
use App\Http\Utils\Helpers;
use Carbon\Carbon;
use App\Models\Tenant\Isp\Commercial\Plan\IspMinimunPermanence;

class IspPlanController extends Controller
{

    public function getMinimunPermanences()
    {
        $obj = IspMinimunPermanence::orderBy('orderBy', 'ASC')->get();

        return response()->json([
            'obj'  => $obj,
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
            $service = IspPlan::with(['lastmile', 'plandetail', 'plandetail.minimunpermanence'])->where('deleted_at', '=', null);

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
        $validator = IspPlan::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['last_mile_id'] = $request->last_mile_id;
        $input['increase'] = $request->increase;
        $input['type_increase'] = $request->type_increase;
        $input['downfall'] = $request->downfall;
        $input['type_downfall'] = $request->type_downfall;
        $input['compartition'] = $request->compartition;
        $obj = IspPlan::create($input);

        $detail['plan_id'] = $obj->id;
        $detail['installation_cost'] = $request->installation_cost;
        $detail['month_cost'] = $request->month_cost;
        $detail['penalty_amount'] = $request->penalty_amount;
        $detail['meters_free'] = $request->meters_free;
        $detail['additional_meter_cost'] = $request->additional_meter_cost;
        $detail['minimun_permanence_id'] = $request->minimun_permanence_id;
        IspPlanDetail::create($detail);

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IspPlan  $ispPlan
     * @return \Illuminate\Http\Response
     */
    public function show(IspPlan $ispPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspPlan  $ispPlan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objPlan = IspPlan::with('plandetail', 'plandetail.minimunpermanence')->find($id);

        return response()->json([
            'objPlan'  => $objPlan,
        ]);
    }

    public function activeRecord(Request $request, $id)
    {
        $obj = IspPlan::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }
    /**
     * Actualiza un registro en específico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $Service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = IspPlan::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $obj = IspPlan::find($id);
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->last_mile_id = $request->last_mile_id;
        $obj->increase = $request->increase;
        $obj->type_increase = $request->type_increase;
        $obj->downfall = $request->downfall;
        $obj->type_downfall = $request->type_downfall;
        $obj->compartition = $request->compartition;
        $obj->save();

        IspPlanDetail::where('plan_id', $id)
            ->update([
                'installation_cost' => $request->installation_cost,
                'month_cost' => $request->month_cost,
                'penalty_amount' =>  $request->penalty_amount,
                'meters_free' => $request->meters_free,
                'additional_meter_cost' => $request->additional_meter_cost,
                'minimun_permanence_id' => $request->minimun_permanence_id,
            ]);

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspPlan  $ispPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objFound = IspPlan::find($id);
        IspPlan::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

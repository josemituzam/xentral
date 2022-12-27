<?php

namespace App\Http\Controllers\Tenant\Setting\Sale;

use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Setting\Company\Branch;
use App\Models\Tenant\Setting\Company\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
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
            $service = Sale::with('getBranch')->where('deleted_at', '=', null);

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getBranch()
    {
        $obj = Branch::where('deleted_at', '=', null)->where('is_active', '=', 1)->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Sale::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['branch_id'] = $request->branch_id;
        $input['description'] = $request->description;
        $input['code'] = $request->code;
        $input['sequential_init'] = $request->sequential_init;
        $input['is_apply_invoice'] = $request->is_apply_invoice;
        $obj = Sale::create($input);
        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $Branch
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $Branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $Branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = Sale::with('getBranch')->find($id);

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
        $validator = Sale::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $obj = Sale::find($id);
        $obj->branch_id = $request->branch_id;
        $obj->description = $request->description;
        $obj->code = $request->code;
        $obj->sequential_init = $request->sequential_init;
        $obj->is_apply_invoice = $request->is_apply_invoice;
        $obj->save();
        return response()->json([
            'obj'  => $obj
        ]);
    }


    public function activeRecord(Request $request, $id)
    {
        $obj = Sale::find($id);
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
    public function destroy($id)
    {
        $objFound = Sale::find($id);
        Sale::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

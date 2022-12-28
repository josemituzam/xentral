<?php

namespace App\Http\Controllers\Tenant\Setting\Branch;

use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Setting\Company\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BranchController extends Controller
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
            $service = Branch::where('deleted_at', '=', null);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Branch::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        } 
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['code'] = $request->code;
        $input['address'] = $request->address;
        $input['phone'] = json_encode($request->phone);
        $input['extention'] = $request->extention;
        $input['email'] = $request->email;
        $obj = Branch::create($input);
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
    public function show(Branch $Branch)
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
        $obj = Branch::find($id);

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
        $validator = Branch::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $obj = Branch::find($id);
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->code = $request->code;
        $obj->address = $request->address;
        $obj->phone = $request->phone;
        $obj->extention = $request->extention;
        $obj->email = $request->email;
        $obj->save();
        return response()->json([
            'obj'  => $obj
        ]);
    }

    
    public function activeRecord(Request $request, $id)
    {
        $obj = Branch::find($id);
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
        $objFound = Branch::find($id);
        Branch::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

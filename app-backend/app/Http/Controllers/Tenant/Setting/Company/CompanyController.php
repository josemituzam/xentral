<?php

namespace App\Http\Controllers\Tenant\Setting\Company;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Setting\Company\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $obj = Company::first();
        $obj["break_day"] = json_decode($obj["break_day"]); 
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Company::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $obj = Company::find($id);
        $obj->name_company = $request->name_company;
        $obj->name_commercial = $request->name_commercial;
        $obj->type_identification = $request->type_identification;
        $obj->identification = $request->identification;
        $obj->is_accounting = $request->is_accounting;
        $obj->is_special = $request->is_special;
        $obj->address = $request->address;
        $obj->phone_principal = json_encode($request->phone_principal);
        $obj->phone_secondary = json_encode($request->phone_secondary);
        $obj->break_day = $request->break_day;
        $obj->decimal = $request->decimal;
        $obj->google_key = $request->google_key;
        $obj->electronic_signature = $request->electronic_signature;
        $obj->save();
        return response()->json([
            'obj'  => $obj
        ]);
    }

}

<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Isp\Commercial\Customer\IspContactCustomer;

class IspContactCustomerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayContact = $request->contacts;
        IspContactCustomer::where('customer_id', $request->id)->delete();

        for ($i = 0; $i < count($arrayContact); $i++) {
            $validator = IspContactCustomer::createdRules($arrayContact[$i]);
            if ($validator->fails()) {
                return response()->json(['isvalid' => $i, 'errors' => $validator->messages()], 422);
            }
            $objData = [
                'customer_id'  =>  $request->id,
                'name'  => $arrayContact[$i]["name"],
                'name_parent'  => $arrayContact[$i]["name_parent"],
                'email'  => $arrayContact[$i]["email"],
                'type_number'  => $arrayContact[$i]["type_number"],
                'phone'  =>  json_encode($arrayContact[$i]["phone"]),
            ];
            IspContactCustomer::create($objData);
        }

        return response()->json([
            'msg'  => '1'
        ]);
    }

    public function validateContact($customerId)
    {
        $obj = IspContactCustomer::where('customer_id', $customerId)->count();
        if ($obj > 0) {
            return response()->json([
                'msg'  => '1'
            ]);
        } else {
            return response()->json([
                'msg'  => '0'
            ]);
        }
    }

    public function edit($id)
    {
        return IspContactCustomer::where('customer_id', $id)->get();
    }
}

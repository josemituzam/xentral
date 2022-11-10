<?php

namespace App\Http\Controllers\Tenant\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Customer\IspContactCustomer;



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
        //  return $request->all();

        $arrayContact = $request->contacts;
        for ($i = 0; $i < count($arrayContact); $i++) {
            /*  if ($arrayContact[$i]["name"] == null) {
            return response()->json(['errors' => [
                'error' => ['Los campos de dejar de hacer no pueden quedar vacíos.'],
            ]], 422);
        }*/
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
    }
}

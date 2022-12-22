<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Contract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Isp\Commercial\Contract\IspContactContract;

class IspContactContractController extends Controller
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
        IspContactContract::where('contract_id', $request->id)->delete();

        for ($i = 0; $i < count($arrayContact); $i++) {
            $validator = IspContactContract::createdRules($arrayContact[$i]);
            if ($validator->fails()) {
                return response()->json(['isvalid' => $i, 'errors' => $validator->messages()], 422);
            }
            $objData = [
                'contract_id'  =>  $request->id,
                'name'  => $arrayContact[$i]["name"],
                'name_parent'  => $arrayContact[$i]["name_parent"],
                'email'  => $arrayContact[$i]["email"],
                'type_number'  => $arrayContact[$i]["type_number"],
                'phone'  =>  json_encode($arrayContact[$i]["phone"]),
            ];
            IspContactContract::create($objData);
        }
    }


    public function edit($customerId, $contractId)
    {
        $objConctactContract = IspContactContract::select(
            'name',
            'name_parent',
            'email',
            'type_number',
            'phone'
        )->where('contract_id', $contractId)->get();
        if ($objConctactContract->count() == 0) {
            return IspContactContract::select(
                'isp_contact_customers.name as name',
                'isp_contact_customers.name_parent as name_parent',
                'isp_contact_customers.email as email',
                'isp_contact_customers.type_number as type_number',
                'isp_contact_customers.phone as phone'
            )
                ->rightJoin('isp_contracts', 'isp_contracts.id', '=', 'isp_contact_contracts.contract_id')
                ->join('isp_contact_customers', 'isp_contact_customers.customer_id', '=', 'isp_contracts.customer_id')
                ->where('isp_contracts.customer_id', $customerId)->get();
        } else {
            return $objConctactContract;
        }
    }
}

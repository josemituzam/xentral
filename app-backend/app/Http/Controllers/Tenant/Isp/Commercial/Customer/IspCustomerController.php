<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenant\Api\ApiR2Controller;
use App\Http\Utils\Helpers;
use App\Models\Tenant\File\File as FileTenant;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class IspCustomerController extends Controller
{

    public function validateCustomer($ide, $type)
    {
        if ($type == 'RUC') {
            $url = 'https://webservices.ec/api/ruc/' . $ide;
        } else {
            $url = 'https://webservices.ec/api/cedula/' . $ide;
        }

        return Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Authorization' => 'Bearer NWCG3zWTtTLmmyiV2CPYrItgYmxeePD6hbwOSfho'
        ])->get($url);
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
            $service = IspCustomer::where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name_company', 'LIKE', "%{$request->q}%")
                            ->orWhere('fullname', 'LIKE', "%{$request->q}%")
                            ->orWhere('identification', 'LIKE', "%{$request->q}%")
                            ->orWhere('address', 'LIKE', "%{$request->q}%");
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
        $validator = IspCustomer::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['address'] = $request->address;
        $input['email'] = $request->email;
        $input['firstname'] = $request->firstname;
        $input['lastname'] = $request->lastname;
        $input['fullname'] = $request->name_company ? $request->name_company : $request->firstname . ' ' . $request->lastname;
        $input['firstname_representative'] = $request->firstname_representative;
        $input['identification'] = $request->identification;
        $input['is_accounting'] = $request->is_accounting;
        $input['is_bond'] = $request->is_bond;
        $input['is_disability'] = $request->is_disability;
        $input['is_old'] = $request->is_old;
        $input['lastname_representative'] = $request->lastname_representative;
        $input['fullname_representative'] = $request->firstname_representative . ' ' . $request->lastname_representative;
        $input['name_company'] = $request->name_company;
        $input['phone'] = json_encode($request->phone);
        $input['started_at'] = $request->started_at;
        $input['type_gender'] = $request->type_gender;
        $input['type_identification'] = $request->type_identification;
        $input['type_number'] = $request->type_number;
        $input['phone_representative'] = json_encode($request->phone_representative);
        $input['type_people'] = $request->type_people;
        $obj = IspCustomer::create($input);

        //Creando el folder del cliente
        Controller::createFolder('customer', $obj->id);
        //Obteniendo el folder del cliente
        $folder = Controller::getFolder('customer', $obj->id);

        if ($request->photo) {
            $methods = new ApiR2Controller();
            $methods->setS3();
            $image = $request->photo;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName =  time();
            Storage::disk('s3')->put($folder['folderImage'] . $imageName, base64_decode($image));
            IspCustomer::where('id', $obj->id)->update([
                'photo' => $folder['folderImage'] . $imageName,
            ]);
        }



        $this->createRecordFiles($obj->id, $obj->type_people);


        return response()->json([
            'obj'  => $obj
        ]);
    }

    public function createRecordFiles($contextableId, $typePeople)
    {
        $objStatus = Controller::getStatus('file', 'isp', 'PTE');
        if ($typePeople == 'PN') {
            $obj = [
                [
                    'name' => 'Ruc Natural',
                    'contextable_id' => $contextableId,
                    'type' => 'file',
                    'status_id' => $objStatus,
                    'long_code' => 'RUCNATURAL',
                    'short_code' => '1'
                ],
                [
                    'name' => 'Pasaporte',
                    'contextable_id' => $contextableId,
                    'type' => 'image',
                    'status_id' => $objStatus,
                    'long_code' => 'PASAPORTE',
                    'short_code' => '2'
                ],
                [
                    'name' => 'Cédula Frontal',
                    'contextable_id' => $contextableId,
                    'type' => 'image',
                    'status_id' => $objStatus,
                    'long_code' => 'CEDULAFRONTAL',
                    'short_code' => '4'
                ],
                [
                    'name' => 'Cédula Posterior',
                    'contextable_id' => $contextableId,
                    'type' => 'image',
                    'status_id' => $objStatus,
                    'long_code' => 'CEDULAPOSTERIOR',
                    'short_code' => '3'
                ],
            ];
        } else {
            if ($typePeople == 'PJ') {
                $obj = [
                    [
                        'name' => 'Ruc Jurídico',
                        'contextable_id' => $contextableId,
                        'type' => 'file',
                        'status_id' => $objStatus,
                        'long_code' => 'RUCJURIDICO',
                        'short_code' => '1'
                    ],
                    [
                        'name' => 'Nombramiento',
                        'contextable_id' => $contextableId,
                        'type' => 'file',
                        'status_id' => $objStatus,
                        'long_code' => 'NOMBRAMIENTO',
                        'short_code' => '2'
                    ],
                    [
                        'name' => 'Cédula Frontal Jurídico',
                        'contextable_id' => $contextableId,
                        'type' => 'image',
                        'status_id' => $objStatus,
                        'long_code' => 'CEDULAFRONTALJURIDICO',
                        'short_code' => '4'
                    ],
                    [
                        'name' => 'Cédula Posterior Jurídico',
                        'contextable_id' => $contextableId,
                        'type' => 'image',
                        'status_id' => $objStatus,
                        'long_code' => 'CEDULAPOSTERIORJURIDICO',
                        'short_code' => '3'
                    ]
                ];
            }
        }

        foreach ($obj as $value) {
            FileTenant::create([
                'name' => $value["name"],
                'contextable_id' => $value["contextable_id"],
                'type' => $value["type"],
                'status_id' => $value["status_id"],
                'long_code' => $value["long_code"],
                'short_code' => $value["short_code"],
            ]);
        }
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
    public function edit($id)
    {
        $obj = IspCustomer::find($id);
        $methods = new ApiR2Controller();
        $methods->setS3();
        if ($obj->photo) {
            $obj['photo'] = Storage::disk("s3")->temporaryUrl($obj->photo, now()->addMinutes(1440));
        }
        return $obj;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspCustomer  $ispCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = IspCustomer::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $obj = IspCustomer::find($id);
        $methods = new ApiR2Controller();
        $methods->setS3();

        //Obteniendo el folder
        $folder = Controller::getFolder('customer', $obj->id);
        if ($obj->photo != null) {
            Storage::disk('s3')->delete($obj->photo);
        }
        if ($request->photo) {
            $image = $request->photo;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName =  time();
            Storage::disk('s3')->put($folder['folderImage'] . $imageName, base64_decode($image));
            $obj->photo = $folder['folderImage'] . $imageName;
        } else {
            $input['photo'] = null;
        }
        $obj->address = $request->address;
        $obj->email = $request->email;
        $obj->firstname = $request->firstname;
        $obj->lastname = $request->lastname;
        $obj->fullname = $request->name_company ? $request->name_company : $request->firstname . ' ' . $request->lastname;
        $obj->firstname_representative = $request->firstname_representative;
        $obj->identification = $request->identification;
        $obj->is_accounting = $request->is_accounting;
        $obj->is_bond = $request->is_bond;
        $obj->is_disability = $request->is_disability;
        $obj->is_old = $request->is_old;
        $obj->lastname_representative = $request->lastname_representative;
        $obj->fullname_representative = $request->fullname_representative;
        $obj->name_company = $request->name_company;
        $obj->phone = json_encode($request->phone);
        $obj->started_at = $request->started_at;
        $obj->type_gender = $request->type_gender;
        $obj->type_identification = $request->type_identification;
        $obj->type_number = $request->type_number;
        $obj->phone_representative = json_encode($request->phone_representative);
        $obj->type_people = $request->type_people;
        $obj->save();

        return response()->json([
            'obj'  => $obj
        ]);
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

<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenant\Api\ApiR2Controller;
use App\Http\Controllers\Tenant\File\FileController;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class IspCustomerController extends Controller
{

    public function storeDocument(Request $request)
    {
        $methodsR2 = new ApiR2Controller();
        $methodFiles = new FileController();
        $typeFile = $methodsR2->saveFile();

        if ($request->file('fileContent')) {
            $file = $request->file('fileContent');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file_name = str_replace(' ', '', $filename);
           // $pathFile = Storage::disk('s3')->put($typeFile->key_file_name . $file_name,  File::get($file));
        }

        if ($request->ideContent) {
            $image = $request->ideContent;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName =  time();
           // $pathImage = Storage::disk('s3')->put($typeFile->key_image_name . $imageName, base64_decode($image));
            $path = $typeFile->key_image_name . $imageName;


            //$url = Storage::url($path);

            $methodFiles->saveFiles($imageName, $path);
        }
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

        if ($request->photo) {
            $methods = new ApiR2Controller();
            $typeFile = $methods->saveFile();
            $image = $request->photo;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName =  time();
            //Storage::disk('s3')->put($typeFile->key_image_name . $imageName, base64_decode($image));
            $input['photo'] = $imageName;
        }

        //Storage::disk('public')->put($imageName, base64_decode($image)); 


        /* $S3 = S3Client::factory([
            'version' => 'latest',
            'region' => 'auto',
            'credentials' => array(
                'key' => $config['S3']['key'],
                'secret' => $config['S3']['secret']
            )
        ]);

        $res = $S3->putObject([
            'Bucket' => $config['S3']['bucket'],
            'Key' => "PATH_TO_FILE{$docname}",
            'Body' => fopen($filepath, 'rb'),
            'ACL' => 'public-read'
        ]); */




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
        $input['phone'] = json_encode($request->phone);
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
    public function edit($id)
    {
        return IspCustomer::find($id);
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

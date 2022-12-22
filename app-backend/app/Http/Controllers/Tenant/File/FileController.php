<?php

namespace App\Http\Controllers\Tenant\File;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenant\Api\ApiR2Controller;
use App\Models\Tenant\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FileStorage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function validateFile($customerId)
    {
        $obj = File::where('contextable_id', $customerId)->whereNotNull('path')->count();
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

    public function getFileCustomer($customerId)
    {
        $obj = File::with('getStatus')->where('contextable_id', $customerId)->orderBy('short_code', 'desc')->get();
        $methods = new ApiR2Controller();
        $methods->setS3();
        for ($i = 0; $i < $obj->count(); $i++) {
            if (isset($obj[$i]->path)) {
                $obj[$i]->path  = Storage::disk("s3")->temporaryUrl($obj[$i]->path, now()->addMinutes(1440));
            }
        }
        return $obj;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function fileCustomer(Request $request)
    {
        $obj = $this->updateFile($request, 'customer');
        return response()->json([
            'obj'  => $obj
        ]);
    }

    public function updateFile($request, $contextableType)
    {
        $obj = File::find($request->id);
        $methods = new ApiR2Controller();
        $methods->setS3();

        if ($obj->path != null) {
            Storage::disk('s3')->delete($obj->path);
        }

        $folder = Controller::getFolder($contextableType, $obj->contextable_id);
        if ($request->type == 'image') {
            if ($request->path) {
                $image = $request->path;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName =  time() . '-' . $obj->long_code;
                Storage::disk('s3')->put($folder['folderImage'] . $imageName, base64_decode($image));
                $obj->path = $folder['folderImage'] . $imageName;
                $obj->filename = $imageName;
                $obj->extention = 'png';
            }
        } else {
            if ($request->file('path')) {
                $file = $request->file('path');
                $filename = time() . '-' . $obj->long_code;
                $file_name = str_replace(' ', '', $filename);
                Storage::disk('s3')->put($folder['folderFile'] . $file_name,  FileStorage::get($file));
                $obj->path = $folder['folderFile'] . $file_name;
                $obj->filename = $file_name;
                $obj->extention = $file->extension();
            }
        }
        $obj->status_id = Controller::getStatus('file', 'isp', 'CGO');
        $obj->save();

        return $obj;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Tenant\Isp\Setting\Template\TemplateContract;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenant\Api\ApiR2Controller;
use App\Models\Tenant\Traits\Template\TemplateContract;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Utils\Helpers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TemplateContractController extends Controller
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
                $columns = array(0 => 'is_active', 1 => 'type_people');
                $param = array(0 => '=', 1 => '=');
                $type = 0;
            }
            $service = TemplateContract::where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name', 'LIKE', "%{$request->q}%");
                    });
                })->paginate(
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = TemplateContract::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $obj = TemplateContract::find($id);
        $obj->name = $request->name;
        $obj->template_code = $request->template_code;
        $obj->orientation = $request->orientation;
        $obj->html = $request->html;
        $obj->margin_bottom = $request->margin_bottom;
        $obj->margin_left = $request->margin_left;
        $obj->margin_top = $request->margin_top;
        $obj->margin_right = $request->margin_right;
        $obj->size = $request->size;
        $obj->save();
        $methods = new ApiR2Controller();
        $methods->setS3();
        Storage::disk('s3')->delete($obj->path);
        $folder = $this->getFolderFile();
        $html = View::make('Contratos.print-pdf', ['html' => $obj->html, 'plantilla' => $obj])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper($obj->size, $obj->orientation)->setWarnings(false);
        $file_name = str_replace(' ', '', $folder['folderFile'] . $obj->name);
        Storage::disk('s3')->put($file_name, $pdf->output());
        TemplateContract::where('id', $obj->id)->update([
            'path' => $file_name,
        ]);

        return response()->json([
            'obj'  => $obj
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
        $validator = TemplateContract::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $input['name'] = $request->name;
        $input['template_code'] = $request->template_code;
        $input['orientation'] = $request->orientation;
        $input['html'] = $request->html;
        $input['margin_bottom'] = $request->margin_bottom;
        $input['margin_left'] = $request->margin_left;
        $input['margin_top'] = $request->margin_top;
        $input['margin_right'] = $request->margin_right;
        $input['size'] = $request->size;
        $obj = TemplateContract::create($input);
        $methods = new ApiR2Controller();
        $methods->setS3();
        $folder = $this->getFolderFile();
        $html = View::make('Contratos.print-pdf', ['html' => $obj->html, 'plantilla' => $obj])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper($obj->size, $obj->orientation)->setWarnings(false);
        $file_name = str_replace(' ', '', $folder['folderFile'] . $obj->name);
        Storage::disk('s3')->put($file_name, $pdf->output());
        TemplateContract::where('id', $obj->id)->update([
            'path' => $file_name,
        ]);

        return response()->json([
            'obj'  => $obj
        ]);
    }


    public function getFolderFile()
    {
        return [
            'folderImage' => 'setting/images/',
            'folderFile' => 'setting/files/',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateContract $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = TemplateContract::find($id);
        $methods = new ApiR2Controller();
        $methods->setS3();
        if ($obj->path) {
            $obj['path'] = Storage::disk("s3")->temporaryUrl($obj->path, now()->addMinutes(1440));
        }
        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function downloadPdf($id)
    {
        $obj = TemplateContract::find($id);
        $html = View::make('Contratos.print-pdf', ['html' => $obj->html, 'plantilla' => $obj])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper($obj->size, $obj->orientation)->setWarnings(false);
        return  $pdf->download($obj->name . '.pdf');
    }

    public function activeRecord(Request $request, $id)
    {
        $obj = TemplateContract::find($id);
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
        $objFound = TemplateContract::find($id);
        TemplateContract::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers\Landlord\Service;

use App\Models\Landlord\Service\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Landlord\Service\ServiceDetail;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Retorna los registros desde la base de datos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasrole('Root')) {

            if (\Request::exists('all')) {
                return response()->json([
                    'obj' =>  Service::get()
                ]);
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
            $service = Service::with(['serviceDetail'])->where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name', 'LIKE', "%{$request->q}%")
                            ->orWhere('description', 'LIKE', "%{$request->q}%");
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
     * Crea los nuevos servicios
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->all();
        $validator = Service::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $objServiceDetail = $request->service_details;


        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $obj = Service::create($input);

        for ($i = 0; $i < count($objServiceDetail); $i++) {
            $objData = [
                'service_id' => $obj->id,
                "min_users" =>  $objServiceDetail[$i]["min_users"],
                'max_users' =>  $objServiceDetail[$i]["max_users"],
                'price_monthly' => $objServiceDetail[$i]["price_monthly"],
                'created_by' =>  auth()->user()->id,
            ];
            ServiceDetail::create($objData);
        }



        return response()->json([
            'obj'  => $obj
        ]);
    }

    /*
     * Se activa o desactiva un registro en específico
     */
    public function activeRecord(Request $request, $id)
    {
        $obj = Service::find($id);
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }


    /**
     * Actualiza un registro en específico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $Service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Service::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $obj = Service::find($id);
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->save();

        $objServiceDetail = $request->service_details;
        ServiceDetail::where('service_id', $id)->delete();
        for ($i = 0; $i < count($objServiceDetail); $i++) {
            $objData = [
                'service_id' => $obj->id,
                "min_users" =>  $objServiceDetail[$i]["min_users"],
                'max_users' =>  $objServiceDetail[$i]["max_users"],
                'price_monthly' => $objServiceDetail[$i]["price_monthly"],
                'created_by' =>  auth()->user()->id,
            ];
            ServiceDetail::create($objData);
        }

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Remueve lógicamente un registro
     *
     * @param  \App\Models\Service  $Service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objFound = Service::find($id);
        Service::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers\Tenant\Sector;

use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Sector\IspSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IspSectorController extends Controller
{

    public function getAllParishCitiesProvinces()
    {
        if (auth('apiTenant')->user()->hasrole('Root')) {
            $description = \DB::select(\DB::raw("SELECT isp_parishes.id, CONCAT(isp_provinces.name, ' - ' ,isp_cities.name, ' - ', isp_parishes.name)  as name
        FROM isp_parishes isp_parishes
        INNER JOIN isp_cities isp_cities ON isp_cities.id=isp_parishes.isp_city_id
        INNER JOIN isp_provinces isp_provinces ON isp_provinces.id=isp_cities.isp_province_id
        "));
            return ($description);
        }
    }

    public function getParishCitiesProvincesByIdParish($idParish)
    {
        if (auth('apiTenant')->user()->hasrole('Root')) {
            $description = \DB::select(\DB::raw("SELECT isp_parishes.id, CONCAT(isp_provinces.name, ' - ' ,isp_cities.name, ' - ', isp_parishes.name)  as name
        FROM isp_parishes isp_parishes
        INNER JOIN isp_cities isp_cities ON isp_cities.id=isp_parishes.isp_city_id
        INNER JOIN isp_provinces isp_provinces ON isp_provinces.id=isp_cities.isp_province_id
        WHERE isp_parishes.id = $idParish LIMIT 1;
        "));
            return ($description);
        }
    }

    public function activeRecord(Request $request, $id)
    {
        $obj = IspSector::find($id);
        $obj->is_active = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
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
                $columns = array(0 => 'is_active');
                $param = array(0 => '=');
                $type = 0;
            }
            $sector = IspSector::where('deleted_at', '=', null);
            $Filtred = $helpers->filter($sector, $columns, $param, $request, $type)
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
        //return $request->all();
        if (auth('apiTenant')->user()->hasrole('Root')) {
            $validator = IspSector::createdRules($request->all());
            if ($validator->fails()) {
                return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
            }
            $input["is_active"] = $request->is_active;
            $input["name"] = $request->name;
            $input["isp_parish_id"] = $request->isp_parish_id;
            $input["latitude"] = $request->latitude;
            $input["longitude"] = $request->longitude;
            $description = ($this->getParishCitiesProvincesByIdParish($input['isp_parish_id']));
            $input["description"] = $description[0]->name;

            $obj = IspSector::create($input);

            return response()->json([
                'obj' => $obj,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //return $id;
        if (auth('apiTenant')->user()->hasrole('Root')) {
            $obj = IspSector::find($id);
            return $obj;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (auth('apiTenant')->user()->hasrole('Root')) {
            $validator = IspSector::updatedRules($request->all());
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()], 422);
            }
            $obj = IspSector::find($id);
            $obj->name = $request->name;
            $obj->description = $request->description;
            $obj->isp_parish_id = $request->isp_parish_id;
            $obj->latitude = $request->latitude;
            $obj->longitude = $request->longitude;
            $description = ($this->getParishCitiesProvincesByIdParish($request->isp_parish_id));
            $obj->description = $description[0]->name;
            $obj->save();

            return response()->json([
                'obj' => $obj,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $objFound = IspSector::find($id);
        IspSector::whereId($objFound->id)->update([
            'deleted_at' => Carbon::now(),
            'is_active' => false,
        ]);
        return response()->json(['success' => true]);
    }
}

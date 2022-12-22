<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Sector;

use App\Http\Controllers\Controller;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Isp\Commercial\Sector\IspLocation;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use App\Models\Tenant\Setting\Company\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IspSectorController extends Controller
{

    public function getCountry()
    {
        $obj = Company::first();

        return response()->json([
            'country' => $obj->country,
        ]);
    }

    public function getLocation($city)
    {
        $obj = IspLocation::where('city', $city)->get();

        return response()->json([
            'obj' => $obj,
        ]);
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
            $sector = IspSector::with(['getLocation'])->where('deleted_at', '=', null);
            $Filtred = $helpers->filter($sector, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('sector', 'LIKE', "%{$request->q}%");
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
        $validator = IspSector::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }
        $location["city"] = $request->city;
        $location["state"] = $request->state;
        $location["location"] = $request->location;
        // 
        if (
            IspLocation::where('isp_locations.location', $request->location)
            ->where('isp_locations.city', $request->city)
            ->where('isp_locations.state', $request->state)->count() == 0
        ) {
            $objLocationId = IspLocation::create($location);
        } else {
            $objLocationId = IspLocation::where('isp_locations.location', $request->location)
                ->where('isp_locations.city', $request->city)
                ->where('isp_locations.state', $request->state)->first();
        }

        $ObjValidate = IspSector::join('isp_locations', 'isp_locations.id', '=', 'isp_sectors.location_id')
            ->where('isp_locations.location', 'like', '%' . $request->location . '%')
            ->where('isp_locations.city', 'like', '%' . $request->city . '%')
            ->where('isp_locations.state', 'like', '%' . $request->state . '%')
            ->where('isp_sectors.sector', 'like', '%' .  $request->sector . '%')->count();

        if ($ObjValidate == 0) {
            $input["sector"] = $request->sector;
            $input["location_id"] = $objLocationId->id;
            $input["latitude"] = $request->latitude;
            $input["longitude"] = $request->longitude;

            $obj = IspSector::create($input);
            return response()->json([
                'obj' => $obj,
            ]);
        } else {
            return response()->json(['isvalid' => false, 'errors' => ['location' => 'Ya existe una localidad registrada']], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IspSector  $ispSector
     * @return \Illuminate\Http\Response
     */
    public function show(IspSector $ispSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspSector  $ispSector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objPlan = IspSector::with('getLocation')->find($id);

        return response()->json([
            'objSector'  => $objPlan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspSector  $ispSector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = IspSector::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        $location["city"] = $request->city;
        $location["state"] = $request->state;
        $location["location"] = $request->location;
        // 
        if (
            IspLocation::where('isp_locations.location', $request->location)
            ->where('isp_locations.city', $request->city)
            ->where('isp_locations.state', $request->state)->count() == 0
        ) {
            $objLocationId = IspLocation::create($location);
        } else {
            $objLocationId = IspLocation::where('isp_locations.location', $request->location)
                ->where('isp_locations.city', $request->city)
                ->where('isp_locations.state', $request->state)->first();
        }

        $ObjValidate = IspSector::join('isp_locations', 'isp_locations.id', '=', 'isp_sectors.location_id')
            ->where('isp_locations.location', 'like', '%' . $request->location . '%')
            ->where('isp_locations.city', 'like', '%' . $request->city . '%')
            ->where('isp_locations.state', 'like', '%' . $request->state . '%')
            ->where('isp_sectors.sector', 'like', '%' .  $request->sector . '%')->count();

        if ($ObjValidate == 0) {
            $obj = IspSector::find($id);
            $obj->sector = $request->sector;
            $obj->location_id = $objLocationId->id;
            $obj->latitude = $request->latitude;
            $obj->longitude = $request->longitude;
            $obj->save();

            return response()->json([
                'obj' => $obj,
            ]);
        } else {
            return response()->json(['isvalid' => false, 'errors' => ['sector' => 'Ya existe un mismo sector registrado']], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspSector  $ispSector
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

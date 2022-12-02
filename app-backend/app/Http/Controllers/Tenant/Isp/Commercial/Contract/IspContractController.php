<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Contract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Isp\Commercial\Contract\IspContract;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Isp\Commercial\Contract\IspAnotherProvider;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;

use App\Models\Tenant\Isp\Commercial\Plan\IspPlan;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use App\Models\Tenant\Traits\Payment\Payment;
use App\Models\Tenant\Traits\Template\TemplateContract;
use Illuminate\Support\Facades\DB;

class IspContractController extends Controller
{
    public function getTemplateContract()
    {
        $obj = TemplateContract::where('is_active', 1)->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getSector()
    {
        $obj = IspSector::join('isp_locations', 'isp_locations.id', '=', 'isp_sectors.location_id')
            ->select(
                DB::raw('CONCAT(isp_sectors.sector," | ",isp_locations.location,", ", isp_locations.city  ,", ", isp_locations.state) as sector_name'),
                'isp_sectors.id as sector_uuid',
                'isp_sectors.latitude as latitude',
                'isp_sectors.longitude as longitude'
            )->get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getAnotherProvider()
    {
        $obj = IspAnotherProvider::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getPayment()
    {
        $obj = Payment::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getPlan($last_mile_id)
    {
        $obj = IspPlan::with('plandetail', 'plandetail.minimunpermanence')->where('last_mile_id', $last_mile_id)->get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getCustomer(Request $request)
    {
        //return "holaaaa";
        $helpers = new Helpers();
        $columns = array();
        $param = array();
        $type = null;

        $searchValues = preg_split('/\s+/', $request->q, -1, PREG_SPLIT_NO_EMPTY);

        $service = IspCustomer::where('deleted_at', '=', null);
        //  str_replace(' ', '', $request->q);
        $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
            ->where(function ($query) use ($request, $searchValues) {
                return $query->when($request->filled('q'), function ($query) use ($request, $searchValues) {
                    foreach ($searchValues as $value) {
                        return $query->Where('fullname', 'LIKE', "%{$value}%")
                            ->orWhere('identification', 'LIKE', "%{$value}%");
                    }
                });
            })->get();

        return $Filtred;
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
            $service = IspContract::where('deleted_at', '=', null);

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
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function show(IspContract $ispContract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function edit(IspContract $ispContract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IspContract $ispContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(IspContract $ispContract)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Plan;

use App\Models\Tenant\Isp\Commercial\Plan\IspLastMiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IspLastMilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = IspLastMiles::get();
        return response()->json([
            'obj'  => $obj
        ]);
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
     * @param  \App\Models\IspLastMiles  $ispLastMiles
     * @return \Illuminate\Http\Response
     */
    public function show(IspLastMiles $ispLastMiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspLastMiles  $ispLastMiles
     * @return \Illuminate\Http\Response
     */
    public function edit(IspLastMiles $ispLastMiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspLastMiles  $ispLastMiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IspLastMiles $ispLastMiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspLastMiles  $ispLastMiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(IspLastMiles $ispLastMiles)
    {
        //
    }
}

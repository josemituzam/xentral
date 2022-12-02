<?php

namespace App\Http\Controllers\Tenant\Note;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Note\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $obj = Note::where('module_short_code', $request->moduleShortCode)->where('reference_id', $request->referenceId)->orderBy('created_at','desc')->get();
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
        $validator = Note::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }
        $input['note'] = $request->note;
        $input['module_short_code'] = $request->module_short_code;
        $input['reference_id'] = $request->reference_id;
        $input['created_by'] = auth('apiTenant')->user()->id;
        $obj = Note::create($input);

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Note::updatedRules($request->all());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        $obj = Note::find($id);
        $obj->note = $request->note;
        $obj->module_short_code = $request->module_short_code;
        $obj->reference_id = $request->reference_id;
        $input['updated_by'] = auth('apiTenant')->user()->id;
        $obj->save();

        return response()->json([
            'obj'  => $obj
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}

<?php

namespace App\Models\Tenant\Note\Traits;

use Illuminate\Support\Facades\Validator;

trait NoteRules
{
    public static function createdRules($note)
    {
        $messages = [
            'note.required' => 'El :attribute es requerido.',
            'module_short_code.required' => 'El :attribute es requerido.',
            'reference_id.required' => 'El :attribute es requerido.',
        ];

        return Validator::make(
            $note,
            [
                'note' => 'required',
                'module_short_code' => 'required',
                'reference_id' => 'required',
            ],
            $messages
        );
    }


    public static function updatedRules($note)
    {
        $messages = [
            'note.required' => 'El :attribute es requerido.',
            'module_short_code.required' => 'El :attribute es requerido.',
        ];

        return Validator::make(
            $note,
            [
                'note' => 'required,',
                'module_short_code' => 'required',
            ],
            $messages
        );
    }
}

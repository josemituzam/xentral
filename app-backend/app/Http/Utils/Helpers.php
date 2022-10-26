<?php

namespace App\Http\Utils;

class Helpers
{
    //  Helper Multiple Filter
    public function filter($model, $columns, $param, $request, $type)
    {
        // Loop through the fields checking if they've been input, if they have add
        //  them to the query.
        $fields = [];
        for ($key = 0; $key < count($columns); $key++) {
            $fields[$key]['param'] = $param[$key];
            $fields[$key]['value'] = $columns[$key];
        }
        if ($type == 1) {
            foreach ($fields as $field) {
                $model->where(function ($query) use ($request, $field, $model) {
                    return $model->when(
                        $request->filled($field['value']),
                        function ($query) use ($request, $model, $field) {
                            $field['param'] = 'like' ?
                                $model->whereDate($field['value'], 'like', "{$request[$field['value']]}")
                                : $model->whereDate($field['value'], $request[$field['value']]);
                        }
                    );
                });
            }
        } else {
            foreach ($fields as $field) {
                $model->where(function ($query) use ($request, $field, $model) {
                    return $model->when(
                        $request->filled($field['value']),
                        function ($query) use ($request, $model, $field) {
                            $field['param'] = 'like' ?
                                $model->where($field['value'], 'like', "{$request[$field['value']]}")
                                : $model->where($field['value'], $request[$field['value']]);
                        }
                    );
                });
            }
        }
        // Finally return the model
        return $model;
    }
}

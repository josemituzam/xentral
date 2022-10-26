<?php
namespace App\Http\Controllers\Core\User;
use App\Http\Controllers\Controller;
use App\Models\Core\Auth\Landlord\User;

class UserController extends Controller
{
    /**
     * Método para mostrar un registro en específico
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $objUser = User::findOrFail($id);
            return response()->json([$objUser], 200);
        } catch (\Exception $e) {
            return response()->json(['isvalid' => false, 'errors' => 'Usuario no existe'], 404);
        }
    }
}

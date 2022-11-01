<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:apiLandlord', ['except' => ['loginInLandlord', 'logout', 'loginInTenant']]);
        // $this->middleware('auth:apiTenant', ['except' => ['loginInTenant']]);
    }

    public function loginInLandlord(Request $request)
    {
        $messages = [
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El correo eletrónico no es válido.',
            'email.min' => 'El correo eletrónico no tiene la longitud correcta.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|min:5|email',
            // 'password' => ['required', 'min:8', 'regex:/^(?=[^\d]*\d)(?=[A-Z\d ]*[^A-Z\d ]).{8,}$/i'],
            'password' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $credentials = request(['email', 'password']);
        $token = auth()->guard()->attempt($credentials);

        if (!$token) {
            return response()->json(['errors' => [
                'email' => ['Las credenciales ingresadas son incorrectas.'],
            ]], 422);
        }

        return $this->respondWithTokenLandlord($token);
    }

    public function logout()
    {
        auth()->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function loginInTenant(Request $request)
    {

        $messages = [
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El correo eletrónico no es válido.',
            'email.min' => 'El correo eletrónico no tiene la longitud correcta.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|min:5|email',
            // 'password' => ['required', 'min:8', 'regex:/^(?=[^\d]*\d)(?=[A-Z\d ]*[^A-Z\d ]).{8,}$/i'],
            'password' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }

        $credentials = request(['email', 'password']);

        $token = auth()->guard('apiTenant')->attempt($credentials);
        if (!$token) {
            return response()->json(['errors' => [
                'email' => ['Las credenciales ingresadas son incorrectas.'],
            ]], 422);
        }

        return $this->respondWithTokenTenant($token);
    }



    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenTenant($token)
    {
        //return auth('apiTenant')->user();
        return response()->json([
            'token' => $token,
            'user' => [
                'id' => auth('apiTenant')->user()->id,
                'email' => auth('apiTenant')->user()->email
            ],
            'expires_in' => auth()->factory()->getTTL() * 1,
        ]);
        /*
        return response()->json([
            'access_token' => $token,
            'authUser' => auth('apiTenant')->user(),
            'expires_in' => auth()->factory()->getTTL() * 1,
        ]);
        */
    }

    protected function respondWithTokenLandlord($token)
    {
        return response()->json([
            'token' => $token,
            'user' => [
                'id' => auth()->user()->id,
                'email' => auth()->user()->email
            ],
            'expires_in' => auth()->factory()->getTTL() * 1,
        ]);
    }
}

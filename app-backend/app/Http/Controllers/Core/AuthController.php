<?php

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\Tenant\User;
use App\Models\Landlord\Setting\Setting;
use App\Models\Tenant\Company\Company;
use App\Models\Tenant\RequestDomain\RequestDomain;
use App\Models\Tenant\ThemeLayout\ThemeLayout;
use App\Models\Tenant\UserDetails\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('apilandlord', ['except' => ['loginLandlord', 'refresh', 'logout']]);
        $this->middleware('apitenant', ['except' => ['loginTenant', 'refresh', 'logout']]);
    }

    private function identical_values($arrayA, $arrayB)
    {

        sort($arrayA);
        sort($arrayB);

        return $arrayA == $arrayB;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userLoggedInTenant(Request $request)
    {
        //  return $request->permissions["is_app_admin"];
        if ($request->user_id && $request->permissions && $request->email) {
            if (auth('apitenant')->check()) {
                if (User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->count() <= 0) {
                    return response()->json(["status" => 403, "message" => 'Usuario no autenticado'], 403);
                }

                if (auth('apitenant')->user()->hasRole('Super Admin')) {
                    if ($request->permissions["is_app_admin"] == 0) {
                        return response()->json(["status" => 403, "message" => 'Usuario no autenticado'], 403);
                    }
                } else {
                    $objUserPermissions = auth('apitenant')->user()->getAllPermissions()->pluck('name')->toArray();;
                    if ($this->identical_values($objUserPermissions, $request->permissions) == false) {
                        return response()->json(["status" => 403, "message" => 'Usuario no autenticado'], 403);
                    }
                }
            } else {
                return response()->json(["status" => 403, "message" => 'Usuario no autenticado'], 403);
            }
        } else {
            return response()->json(["status" => 403, "message" => 'Usuario no autenticado'], 403);
        }
    }

    public function loginTenant(Request $request)
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

        $token = auth()->guard('apitenant')->attempt($credentials);
        if (!$token) {
            return response()->json(['errors' => [
                'email' => ['Las credenciales ingresadas son incorrectas.'],
            ]], 422);
        }

        return $this->respondWithTokenTenant($token);
    }

    public function loginLandlord(Request $request)
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

        $token = auth()->guard('apilandlord')->attempt($credentials);

        if (!$token) {
            return response()->json(['errors' => [
                'email' => ['Las credenciales ingresadas son incorrectas.'],
            ]], 422);
        }

        return $this->respondWithTokenLandlord($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logoutTenant(Request $request)
    {
        //get bearer token
        $token = $request->bearerToken();


        if (!isset($token)) {
            return response()->json([
                'success' => false,
                'message' => 'Token is not set, please retry action or login.'
            ]);
        }

        //Invalidate and blacklist methods
        try {
            //JWTAuth::invalidate(JWTAuth::getToken());
            //JWTAuth::invalidate($request->bearerToken());
            //auth("api")->invalidate(true);
            //JWTAuth::invalidate($request->token);
            //JWTAuth::parseToken()->invalidate();
            //\Illuminate\Support\Facades\Auth::setToken($token)->invalidate(true);
            auth()->guard('apitenant')->logout();
            JWTAuth::setToken($token)->invalidate(true);

            //auth("api")->logout(true);
            //JWTAuth::invalidate(true);
            //\JWTAuth::manager()->invalidate(new \PHPOpenSourceSaver\JWTAuth\Token($token), $forceForever = true);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (TokenExpiredException $e) {
            // Refresh token has expired

            return response()->json([
                "status" => 400,
                "message" => "El token ingresado no puede ser actualizado"
            ], 400);
        } catch (TokenBlacklistedException $e) {
            // Access token has be list to blacklist. You must re-log into the system.
            return response()->json([
                "status" => 400,
                "message" => "El token ingresado se encuentra en la lista negra"
            ], 400);
        }
    }

    public function logoutLandlord(Request $request)
    {
        //get bearer token
        $token = $request->bearerToken();


        if (!isset($token)) {
            return response()->json([
                'success' => false,
                'message' => 'Token is not set, please retry action or login.'
            ]);
        }

        //Invalidate and blacklist methods
        try {
            //JWTAuth::invalidate(JWTAuth::getToken());
            //JWTAuth::invalidate($request->bearerToken());
            //auth("api")->invalidate(true);
            //JWTAuth::invalidate($request->token);
            //JWTAuth::parseToken()->invalidate();
            //\Illuminate\Support\Facades\Auth::setToken($token)->invalidate(true);
            auth()->guard('apilandlord')->logout();
            JWTAuth::setToken($token)->invalidate(true);

            //auth("api")->logout(true);
            //JWTAuth::invalidate(true);
            //\JWTAuth::manager()->invalidate(new \PHPOpenSourceSaver\JWTAuth\Token($token), $forceForever = true);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (TokenExpiredException $e) {
            // Refresh token has expired

            return response()->json([
                "status" => 400,
                "message" => "El token ingresado no puede ser actualizado"
            ], 400);
        } catch (TokenBlacklistedException $e) {
            // Access token has be list to blacklist. You must re-log into the system.
            return response()->json([
                "status" => 400,
                "message" => "El token ingresado se encuentra en la lista negra"
            ], 400);
        }
    }
    /*
    public function logout()
    {
        config([
            'jwt.blacklist_enabled' => true
        ]);
        auth()->guard('api')->logout();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }*/

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json("", 401);
            }
            //refresh token
            $newtoken = JWTAuth::refresh(JWTAuth::getToken()); // or assign original token that hasn't expired yet.
            return response()->json([
                'access_token' => $newtoken,
            ]);
        } catch (TokenExpiredException $e) {
            // Access token has expired
            try {
                $newtoken = JWTAuth::refresh(JWTAuth::getToken());
                return response()->json([
                    'access_token' => $newtoken,
                ]);
            } catch (TokenExpiredException $e) {
                // Refresh token has expired
                return response()->json([
                    "status" => 400,
                    "message" => "El token ingresado no puede ser actualizado"
                ], 400);
            } catch (TokenBlacklistedException $e) {
                // Access token has be list to blacklist. You must re-log into the system.
                return response()->json([
                    "status" => 400,
                    "message" => "El token ingresado se encuentra en la lista negra"
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json(["status" => 400, "message" => 'Authorization Token not found'], 400);
        }


        /*
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json(["status" => 400, "message" => 'Authorization Token not found'], 400);
        }
        try {
            $tokenRefresh = JWTAuth::refresh($token);
        } catch (TokenInvalidException $e) {
            return response()->json(["status" => 401, "message" => 'Token Invalid'], 401);
        }
        return response()->json([
            'access_token' => $tokenRefresh,
        ]);*/
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
        $permissions = [];
        if (auth('apitenant')->user()->hasRole('Super Admin')) {
            $permissions = ['is_app_admin' => true];
        } else {
            $permissions =
                auth('apitenant')->user()->getAllPermissions()->pluck('name')->toArray();
        }

        if (auth('apitenant')->user()->hasRole('Super Admin')) {
            $role = 'admUser';
        } else {
            if (auth('apitenant')->user()->hasRole('Supervisor')) {
                $role = 'supUser';
            } else {
                if (auth('apitenant')->user()->hasRole('General')) {
                    $role = 'genUser';
                }
            }
        }

        $objUserDetail = UserDetails::where("user_id", '=', auth('apitenant')->user()->id)->first();
        $objRequestDomain = RequestDomain::first();
        $objThemeLayout = ThemeLayout::where("id", '=', $objRequestDomain->theme_layouts_id)->first();
        $objCompany = Company::where("id", '=', $objUserDetail->company_id)->first();
        $objSetting = Setting::where('context', 'app')->get();
        $settings = [];
        foreach ($objSetting as $row) {
            $settings[$row->key] = $row->value;
        }

        $objJsonUser =  [
            'email' =>  auth('apitenant')->user()->email,
            'user_id' =>  auth('apitenant')->user()->id,
        ];
        $objJsonUserDetail =  [
            'fullname' =>  $objUserDetail->fullname,
        ];
        $objJsonCompany =  [
            'name' =>  $objCompany->name,
            'request_domain_id' => $objCompany->request_domain_id
        ];

        return response()->json([
            'access_token' => $token,
            'authUser' =>  $objJsonUser,
            'permissions' => $permissions,
            'role' =>  $role,
            'objUserDetail' => $objJsonUserDetail,
            'objThemeLayout' => $objThemeLayout,
            'objSetting' => $settings,
            'objCompany' => $objJsonCompany,
            //  'refresh_token' => auth()->refresh(),
            'expires_in' => auth()->factory()->getTTL() * 1,
            /* 'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 3600,
            */
        ]);
    }

    protected function respondWithTokenLandlord($token)
    {
        $permissions = [];
        if (auth('apilandlord')->user()->hasRole('Super Admin')) {
            $permissions = ['is_app_admin' => true];
        } else {
            $permissions =
                auth('apilandlord')->user()->getAllPermissions()->pluck('name')->toArray();
        }

        if (auth('apilandlord')->user()->hasRole('Super Admin')) {
            $role = 'admUser';
        } else {
            if (auth('apilandlord')->user()->hasRole('Supervisor')) {
                $role = 'supUser';
            } else {
                if (auth('apilandlord')->user()->hasRole('General')) {
                    $role = 'genUser';
                }
            }
        }

        $objUserDetail = UserDetails::where("user_id", '=', auth('apilandlord')->user()->id)->first();
        $objCompany = Company::where("id", '=', $objUserDetail->company_id)->first();
        $objThemeLayout = ThemeLayout::where("id", '=', $objCompany->theme_layouts_id)->first();
        $objSetting = Setting::where('context', 'app')->get();
        $settings = [];
        foreach ($objSetting as $row) {
            $settings[$row->key] = $row->value;
        }

        return response()->json([
            'access_token' => $token,
            'authUser' => auth('apilandlord')->user(),
            'permissions' => $permissions,
            'role' =>  $role,
            'objUserDetail' => $objUserDetail,
            'objThemeLayout' => $objThemeLayout,
            'objSetting' => $settings,
            'objCompany' => $objCompany,
            //  'refresh_token' => auth()->refresh(),
            'expires_in' => auth()->factory()->getTTL() * 1,
            /* 'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 3600,
            */
        ]);
    }
}

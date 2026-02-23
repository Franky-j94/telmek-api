<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('login', 'password');
        /* Tambien se puede de esta manera, valida directamente todo, pero en el json seria solo un mensaje
        $credentials = [
            'login' => $request->login,
            'password' => $request->password,
            'activo' => true
        ];*/

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Credenciales incorrectas'
            ], 401);
        }
        // despues de validar el login y password verificamos que el usuario este activo
        $user = \App\Models\User::where('login', $request->login)->first();
        if ($user && !$user->activo) {
            return response()->json(['error' => 'Usuario inactivo'], 403);
        }
        return $this->respondWithToken($token, $user);
    }

    /**
     * Obtener usuario autenticado
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Refresh token
     */
    public function refresh()
    {
        try {
            $newToken = auth('api')->refresh();

            return $this->respondWithToken($newToken);

        }
        catch (\Exception $e) {

            return response()->json([
                'error' => 'Refresh token inválido'
            ], 401);
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        auth('api')->logout(true); // Invalida access y refresh

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    /**
     * Formato de respuesta del token
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
                'user' => $user
            ]
        ]);
    }

    protected function redirectTo($request)
    {
        return null;
    }
}
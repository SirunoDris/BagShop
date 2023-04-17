<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\Validator;


class LoginController extends Controller
{
    /**
     * Register and create token
     */
    public function register(Request $request){

        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string'
        ]);
        if(!$request){
            return response()->json($request->errors());
        }
        $user= User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password)
        ]);
        //token user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=> 'Usuario registrado correctamente',
            'user'=> $user,
            'token'=>$token
        ],201);
    }
    /**
     * Login user and create token
     *
     */
    public function login(Request $request)
    {
        //Primero validamos
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //recogemos las credenciales
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken($request->name)->plainTextToken;
      
        return response()->json([
            'token' => $tokenResult,
            'token_type' => 'Bearer',
            'message' => 'Success'
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();
        }
    
        return response()->json([
            'message' => 'User Successfully logged out'
        ], 201);
         
        
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

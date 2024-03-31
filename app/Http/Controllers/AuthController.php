<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Creates a user using the inputs from request
     * POST: /api/register
     * @param Request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request){
        $validator = validator($request->all(), [
            "name" => "required|unique:users|min:4|string",
            "email" => "required|unique:users|email",
            "password" => "required|string|min:8|confirmed",
            "first_name" => "required|string|min:2",
            "middle_name" => "sometimes|string|min:2",
            "last_name" => "required|string|min:2",
            "birth_date" => "required|date"
        ]);

        if($validator->fails()){
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $user_input = $validator->safe()->only(["name", "email", "password"]);
        $profile_input = $validator->safe()->except(["name", "email", "password"]);

        $user = User::create($user_input);
        $user->profile()->create($profile_input);
        $user->profile;
        $user->token = $user->createToken("registration_token")->accessToken; 

        return response()->json([
            "ok" => true,
            "message" => "Registered Successfully!",
            "data" => $user
        ], 201);
    }


    /**
     * Login using the inputs from request
     * POST: /api/login
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $validator = validator($request->all(), [
            "name" => "required",
            "password" => "required"
        ]);
        
        if($validator->fails()){
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        if(!auth()->attempt($validator->validated())){
            return response()->json([
                "ok" => false,
                "message" => "Invalid Credentials!"
            ], 401);
        }

        $user = auth()->user();

        
        $user->profile;
        $user->token = $user->createToken("login_token")->accessToken;

        return response()->json([
            "ok" => true,
            "message" => "Login Successfully!",
            "data" => $user
        ], 200);
    }

    /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function checkToken(Request $request){
        $user = $request->user();
        $user->profile;
        return response()->json([
            "ok" => true,
            "message" => "User Info has been retrieved!",
            "data" => $user
        ], 200);
    }
    
}

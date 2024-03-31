<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "User Info has been retrieved!",
            "data" => User::with("profile")->get()
        ], 200);
    }


    /**
     * Creates a user using the inputs from request
     * POST: /api/userww
     * @param Request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request){
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

        return response()->json([
            "ok" => true,
            "message" => "Account has been Created!",
            "data" => $user
        ], 201);
    }

    /** 
     * Retrieve specific user using id
     * GET: /api/users/{user}
     * @param Request
     * @param User
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user){
        $user->profile;
        return response()->json([
            "ok" => true,
            "message" => "User Info has been retrieved!",
            "data" => $user
        ], 200);
    }

    /** 
     * Update specific user using inputs from request and id from URI
     * PATCH: /api/users/{user}
     * @param Request
     * @param User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        $validator = validator($request->all(), [
            "email" => "required|unique:users|email",
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
        
        $user_input = $validator->safe()->only(["email"]);
        $profile_input = $validator->safe()->except(["email"]);

        $user->update($user_input);
        $user->profile()->update($profile_input);
        $user->profile;

        return response()->json([
            "ok" => true,
            "message" => "User Info has been Updated!",
            "data" => $user
        ], 200);
    }

    /** 
     * Delete specific user using id from URI
     * DELETE: /api/users/{user}
     * @param Request
     * @param User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user){
        $user->delete();
        return response()->json([
            "ok" => true,
            "message" => "User has been Deleted!"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function membership_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "Membership Info has been retrieved!",
            
        ], 200);
    }
public function membership_store(Request $request){
    $validator = validator($request->all(), [
        "promo_id"=>"exists:promos,id|required",
        "profile_id"=>"exists:profiles,user_id|required",
     
       
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }

   $validated = $validator->validated();

   $membership_input = Membership::create([
        'promo_id'=> $validated['promo_id'],
        'profile_id'=> $validated['profile_id'],
      
       
   ]);

    return response()->json([
        "ok" => true,
        "message" => "Membership has been Created!",
        "data" => $membership_input
    ], 201);
}

/** 
     * Retrieve specific membership using id
     * GET: /api/memberships/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
public function membership_show(Request $request, Doctor $doctor){
    return response()->json([
        "ok" => true,
        "message" => "Membership Info has been retrieved!",
        "data" => $membership_input
    ], 200);
}

/** 
     * Update specific membership using inputs from request and id from URI
     * PATCH: /api/membership/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
public function membership_update(Request $request, Doctor $doctor){
    $validator = validator($request->all(), [
        "promo_id"=>"exists:promo,id",
        "description"=>"required|string",
        "cost" => "required|integer"
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }
    $validated = $validator->validated();
    $membership_input = Membership::create([
        'promo_id'=> $validated['promo_id'],
        'description'=> $validated['description'],
        'cost'=> $validated['cost'],
   ]);

    return response()->json([
        "ok" => true,
        "message" => "Membership Info has been Updated!",
        "data" => $membership_input
    ], 200);
}
/** 
     * Delete specific membership using id from URI
     * DELETE: /api/memberships/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
    public function membership_destroy(Request $request, Membership $membership){
        $membership->delete();
        return response()->json([
            "ok" => true,
            "message" => "Membership has been Deleted!"
        ], 200);
    }
}

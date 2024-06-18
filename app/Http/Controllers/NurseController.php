<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;

class NurseController extends Controller
{
   /**
     * Retrieve the nurse info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function nurse_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "Nurses Info has been retrieved!",
            
        ], 200);
    }
public function nurse_store(Request $request){
    $validator = validator($request->all(), [
        "user_id"=>"exists:nurse,nurse_id",
        "name" => "required|min:4|string",
        "address" => "required|string",
        "years_of_service" => "required|integer"
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }

    $validated = $validator->validated();

    $nurse_input = Nurse::create([
        'user_id' => $validated['user_id'], 
        'name' => $validated['name'],
        'address' => $validated['address'],
        'years_of_service' => $validated['years_of_service'],
    ]);
    

    return response()->json([
        "ok" => true,
        "message" => "Nurse has been Created!",
        "data" => $nurse_input
    ], 201);
}

/** 
     * Retrieve specific Nurse using id
     * GET: /api/Nurses/{Nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
public function nurse_show(Request $request, Nurse $nurse){
    return response()->json([
        "ok" => true,
        "message" => "Nurses Info has been retrieved!",
        "data" => $nurse_input
    ], 200);
}

/** 
     * Update specific Nurse using inputs from request and id from URI
     * PATCH: /api/Nurses/{Nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
public function nurse_update(Request $request, Nurse $nurse){
    $validator = validator($request->all(), [
        
        "name" => "required|min:4|string",
        "address" => "required|string",
        "years_of_service" => "required|integer"
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }
    
    $validated = $validator->validated();

    $nurse_input->Nurse::update([
        'name' => $validated['name'],
        'address' => $validated['address'],
        'years_of_service' => $validated['years_of_service'],
    ]);

    return response()->json([
        "ok" => true,
        "message" => "Nurse Info has been Updated!",
        "data" => $nurse_input
    ], 200);
}
/** 
     * Delete specific nurse using id from URI
     * DELETE: /api/nurses/{nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
    public function nurse_destroy(Request $request, Nurse $nurse){
        $nurse->delete();
        return response()->json([
            "ok" => true,
            "message" => "Nurse has been Terminated!"
        ], 200);
    }  
}

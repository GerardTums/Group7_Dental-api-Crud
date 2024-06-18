<?php

namespace App\Http\Controllers;
use App\Models\Dentist;
use Illuminate\Http\Request;


class DentistController extends Controller
{
     /**
     * Retrieve the Dentist info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function dentist_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "Dentist Info has been retrieved!",
            
        ], 200);
    }
public function dentist_store(Request $request){
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
/*
    $dentist_input = $validator->safe()->only(["name","address", "year_of_service"]);
    $dentist = Dentist::create($dentist_input);
    */
    $validated = $validator->validated();

    $dentist_input = Dentist::create([
        'name' => $validated['name'],
        'address' => $validated['address'],
        'years_of_service' => $validated['years_of_service'],
    ]);

    return response()->json([
        "ok" => true,
        "message" => "Dentist has been Created!",
        "data" => $dentist_input
    ], 201);
}

/** 
     * Retrieve specific dentist using id
     * GET: /api/dentist/{dentist}
     * @param Request
     * @param Dentist
     * @return \Illuminate\Http\Response
     */
public function dentist_show(Request $request, Dentist $dentist){
    return response()->json([
        "ok" => true,
        "message" => "Dentist Info has been retrieved!",
        "data" => $dentist_input
    ], 200);
}

/** 
     * Update specific dentist using inputs from request and id from URI
     * PATCH: /api/dentists/{dentist}
     * @param Request
     * @param Dentist
     * @return \Illuminate\Http\Response
     */
public function dentist_update(Request $request, Dentist $dentist){
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

    $dentist_input = Dentist::update([
        'name' => $validated['name'],
        'address' => $validated['address'],
        'years_of_service' => $validated['years_of_service'],
    ]);

    return response()->json([
        "ok" => true,
        "message" => "Dentist Info has been Updated!",
        "data" => $dentist_input
    ], 200);
}
/** 
     * Delete specific dentist using id from URI
     * DELETE: /api/dentists/{dentist}
     * @param Request
     * @param Dentist
     * @return \Illuminate\Http\Response
     */
    public function dentist_destroy(Request $request, Dentist $dentist){
        $dentist->delete();
        return response()->json([
            "ok" => true,
            "message" => "Dentist has been Terminated!"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
     /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function promo_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "promo Info has been retrieved!",
            
        ], 200);
    }
public function promo_store(Request $request){
    $validator = validator($request->all(), [
        "discount" => "required|decimal",
        "description" => "required|string",
        "price" => "required|integer",
        "promo_name" => "required|string",
        "promo_end" => "required|date",
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }
/*
    $promo_input = $validator->safe()->only(["name","address", "year_of_service"]);
    $promo = promo::create($promo_input);
    */
    $validated = $validator->validated();

    $promo_input = promo::create([
        'discount' => $validated['discount'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'promo_name' => $validated['promo_name'],
        'promo_end' => $validated['promo_end'],
    ]);

    return response()->json([
        "ok" => true,
        "message" => "promo has been Created!",
        "data" => $promo_input
    ], 201);
}

/** 
     * Retrieve specific Promo using id
     * GET: /api/promos/{promo}
     * @param Request
     * @param Promo
     * @return \Illuminate\Http\Response
     */
public function promo_show(Request $request, Promo $promo){
    return response()->json([
        "ok" => true,
        "message" => "Promos Info has been retrieved!",
        "data" => $promo
    ], 200);
}

/** 
     * Update specific promo using inputs from request and id from URI
     * PATCH: /api/promos/{promo}
     * @param Request
     * @param Promo
     * @return \Illuminate\Http\Response
     */
public function promo_update(Request $request, promo $promo){
    $validator = validator($request->all(), [
        "discount" => "required|decimal",
        "description" => "required|string",
        "price" => "required|integer",
        "promo_name" => "required|string",
        "promo_end" => "required|date",
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }
    
    $validated = $validator->validated();

    $promo->update([
        'discount' => $validated['discount'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'promo_name' => $validated['promo_name'],
        'promo_end' => $validated['promo_end'],
    ]);

    return response()->json([
        "ok" => true,
        "message" => "Promo Info has been Updated!",
        "data" => $promo
    ], 200);
}
/** 
     * Delete specific promo using id from URI
     * DELETE: /api/promos/{promo}
     * @param Request
     * @param Promo
     * @return \Illuminate\Http\Response
     */
    public function promo_destroy(Request $request, promo $promo){
        $promo->delete();
        return response()->json([
            "ok" => true,
            "message" => "Promo has been Terminated!"
        ], 200);
    }
}

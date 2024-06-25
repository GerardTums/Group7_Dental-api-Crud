<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function procedure_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "Procedure Info has been retrieved!",
            
        ], 200);
    }
public function procedure_store(Request $request){
    $validator = validator($request->all(), [
        "promo_id"=>"exists:promos,id|required",
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

   $procedure_input = Procedure::create([
        'promo_id'=> $validated['promo_id'],
        'description'=> $validated['description'],
        'cost'=> $validated['cost'],
       
   ]);

    return response()->json([
        "ok" => true,
        "message" => "Procedures has been Created!",
        "data" => $procedure_input
    ], 201);
}

/** 
     * Retrieve specific procedures using id
     * GET: /api/procedures/{procedures}
     * @param Request
     * @param Procedures
     * @return \Illuminate\Http\Response
     */
public function procedure_show(Request $request, Doctor $doctor){
    return response()->json([
        "ok" => true,
        "message" => "Procedure Info has been retrieved!",
        "data" => $procedure_input
    ], 200);
}

/** 
     * Update specific procedure using inputs from request and id from URI
     * PATCH: /api/procedures/{procedure}
     * @param Request
     * @param Procedure
     * @return \Illuminate\Http\Response
     */
public function procedure_update(Request $request, Doctor $doctor){
    $validator = validator($request->all(), [
        "promo_id"=>"exists:promos,id|required",
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
    $procedure_input = Procedure::create([
        'promo_id'=> $validated['promo_id'],
        'description'=> $validated['description'],
        'cost'=> $validated['cost'],
   ]);

    return response()->json([
        "ok" => true,
        "message" => "Procedure Info has been Updated!",
        "data" => $procedure_input
    ], 200);
}
/** 
     * Delete specific procedure using id from URI
     * DELETE: /api/procedure/{procedure}
     * @param Request
     * @param Procedure
     * @return \Illuminate\Http\Response
     */
    public function procedure_destroy(Request $request, Procedure $procedure){
        $procedure->delete();
        return response()->json([
            "ok" => true,
            "message" => "Procedure has been Deleted!"
        ], 200);
    }
}

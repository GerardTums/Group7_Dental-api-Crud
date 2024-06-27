<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NurseController extends Controller
{
    /**
     * Retrieve the nurse info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function nurse_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Nurses info has been retrieved!",
        ], 200);
    }

    /**
     * Store a newly created nurse in the database
     * POST: /api/nurses
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function nurse_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => "exists:profiles,user_id|required",
            "name" => "required|min:4|string",
            "address" => "required|string",
            "years_of_service" => "required|integer"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $nurse = Nurse::create([
            'user_id' => $validated['user_id'], 
            'name' => $validated['name'],
            'address' => $validated['address'],
            'years_of_service' => $validated['years_of_service'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Nurse has been created!",
            "data" => $nurse
        ], 201);
    }

    /** 
     * Retrieve specific nurse using id
     * GET: /api/nurses/{nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
    public function nurse_show(Request $request, Nurse $nurse)
    {
        return response()->json([
            "ok" => true,
            "message" => "Nurse info has been retrieved!",
            "data" => $nurse
        ], 200);
    }

    /** 
     * Update specific nurse using inputs from request and id from URI
     * PATCH: /api/nurses/{nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
    public function nurse_update(Request $request, Nurse $nurse)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => "exists:profiles,user_id|required",
            "name" => "required|min:4|string",
            "address" => "required|string",
            "years_of_service" => "required|integer"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $nurse->update([
            'user_id' => $validated['user_id'], 
            'name' => $validated['name'],
            'address' => $validated['address'],
            'years_of_service' => $validated['years_of_service'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Nurse info has been updated!",
            "data" => $nurse
        ], 200);
    }

    /** 
     * Delete specific nurse using id from URI
     * DELETE: /api/nurses/{nurse}
     * @param Request
     * @param Nurse
     * @return \Illuminate\Http\Response
     */
    public function nurse_destroy(Request $request, Nurse $nurse)
    {
        $nurse->delete();
        return response()->json([
            "ok" => true,
            "message" => "Nurse has been terminated!"
        ], 200);
    }  
}

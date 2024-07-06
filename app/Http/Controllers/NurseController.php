<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NurseController extends Controller
{
    /**
     * Retrieve the nurse info using bearer token
     * GET: /api/nurse
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function nurse_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Nurses info has been retrieved!",
            "data" => Nurse::all()

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
            "name" => "required|min:4|string",
            "address" => "required|string",
            "hire_date" => "required|date"
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
            'name' => $validated['name'],
            'address' => $validated['address'],
            'hire_date' => $validated['hire_date'],
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
            "name" => "required|min:4|string",
            "address" => "required|string",
            "hire_date" => "required|date"        
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
            'name' => $validated['name'],
            'address' => $validated['address'],
            'hire_date' => $validated['hire_date'],
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

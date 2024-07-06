<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedure; // Ensure you import the Procedure model
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
{
    /**
     * Retrieve the procedure info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function procedure_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Procedure info has been retrieved!",
            "data" => Procedure::all()
        ], 200);
    }

    /**
     * Store a newly created procedure in the database
     * POST: /api/procedures
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function procedure_store(Request $request)
    {
        $validator = validator($request->all(), [
            "promo_id" => "exists:promos,id|required",
            "description" => "required|string",
            "cost" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $procedure = Procedure::create([
            'promo_id' => $validated['promo_id'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Procedure has been created!",
            "data" => $procedure
        ], 201);
    }

    /** 
     * Retrieve specific procedure using id
     * GET: /api/procedures/{procedure}
     * @param Request
     * @param Procedure
     * @return \Illuminate\Http\Response
     */
    public function procedure_show(Request $request, Procedure $procedure)
    {
        return response()->json([
            "ok" => true,
            "message" => "Procedure info has been retrieved!",
            "data" => $procedure
        ], 200);
    }

    /** 
     * Update specific procedure using inputs from request and id from URI
     * PATCH: /api/procedures/{procedure}
     * @param Request
     * @param Procedure
     * @return \Illuminate\Http\Response
     */
    public function procedure_update(Request $request, Procedure $procedure)
    {
        $validator = validator($request->all(), [
            "promo_id" => "exists:promos,id|required",
            "description" => "required|string",
            "cost" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $procedure->update([
            'promo_id' => $validated['promo_id'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Procedure info has been updated!",
            "data" => $procedure
        ], 200);
    }

    /** 
     * Delete specific procedure using id from URI
     * DELETE: /api/procedures/{procedure}
     * @param Request
     * @param Procedure
     * @return \Illuminate\Http\Response
     */
    public function procedure_destroy(Request $request, Procedure $procedure)
    {
        $procedure->delete();
        return response()->json([
            "ok" => true,
            "message" => "Procedure has been deleted!"
        ], 200);
    }
}


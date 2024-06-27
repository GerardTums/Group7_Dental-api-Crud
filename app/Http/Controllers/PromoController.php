<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo; // Make sure to import the Promo model
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function promo_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Promo info has been retrieved!",
        ], 200);
    }

    /**
     * Store a newly created promo in the database
     * POST: /api/promos
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function promo_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "discount" => "required",
            "description" => "required|string",
            "price" => "required|integer",
            "promo_name" => "required|string",
            "promo_end" => "required|date",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $promo = Promo::create([
            'discount' => $validated['discount'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'promo_name' => $validated['promo_name'],
            'promo_end' => $validated['promo_end'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Promo has been created!",
            "data" => $promo
        ], 201);
    }

    /** 
     * Retrieve specific promo using id
     * GET: /api/promos/{promo}
     * @param Request
     * @param Promo
     * @return \Illuminate\Http\Response
     */
    public function promo_show(Request $request, Promo $promo)
    {
        return response()->json([
            "ok" => true,
            "message" => "Promo info has been retrieved!",
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
    public function promo_update(Request $request, Promo $promo)
    {
        $validator = Validator::make($request->all(), [
            "discount" => "required",
            "description" => "required|string",
            "price" => "required|integer",
            "promo_name" => "required|string",
            "promo_end" => "required|date",
        ]);

        if ($validator->fails()) {
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
            "message" => "Promo info has been updated!",
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
    public function promo_destroy(Request $request, Promo $promo)
    {
        $promo->delete();
        return response()->json([
            "ok" => true,
            "message" => "Promo has been terminated!"
        ], 200);
    }
}

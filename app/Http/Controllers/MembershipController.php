<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership; // Ensure you import the Membership model
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    /**
     * Retrieve the membership info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function membership_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Membership info has been retrieved!",
        ], 200);
    }

    /**
     * Store a newly created membership in the database
     * POST: /api/memberships
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function membership_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "promo_id" => "exists:promos,id|required",
            "profile_id" => "exists:profiles,user_id|required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $membership = Membership::create([
            'promo_id' => $validated['promo_id'],
            'profile_id' => $validated['profile_id'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Membership has been created!",
            "data" => $membership
        ], 201);
    }

    /** 
     * Retrieve specific membership using id
     * GET: /api/memberships/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
    public function membership_show(Request $request, Membership $membership)
    {
        return response()->json([
            "ok" => true,
            "message" => "Membership info has been retrieved!",
            "data" => $membership
        ], 200);
    }

    /** 
     * Update specific membership using inputs from request and id from URI
     * PATCH: /api/memberships/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
    public function membership_update(Request $request, Membership $membership)
    {
        $validator = Validator::make($request->all(), [
            "promo_id" => "exists:promos,id|required",
            "profile_id" => "exists:profiles,user_id|required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $membership->update([
            'promo_id' => $validated['promo_id'],
            'profile_id' => $validated['profile_id'],
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Membership info has been updated!",
            "data" => $membership
        ], 200);
    }

    /** 
     * Delete specific membership using id from URI
     * DELETE: /api/memberships/{membership}
     * @param Request
     * @param Membership
     * @return \Illuminate\Http\Response
     */
    public function membership_destroy(Request $request, Membership $membership)
    {
        $membership->delete();
        return response()->json([
            "ok" => true,
            "message" => "Membership has been deleted!"
        ], 200);
    }
}
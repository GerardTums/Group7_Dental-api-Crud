<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Rules\Time;

class AppointmentController extends Controller
{
    /**
     * GET: /api/appointments
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function appointment_index(Request $request)
    {
        return response()->json([
            "ok" => true,
            "message" => "Appointment Info has been retrieved!",
            "data" => Appointment::all()

        ], 200);
    }

    public function appointment_store(Request $request)
    {
        $validator = validator($request->all(), [
            "name" => "required|string",
            "address" => "required|string",
            "dentist_id" => "exists:dentists,id|required",
            "nurse_id" => "exists:nurses,id|required",          
            "procedure_id" => "exists:procedures,id|required",
            "treatment_date" => "required|date",
            "treatment_time" => ["required", new Time],
   
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();

        $appointment_input = Appointment::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'dentist_id' => $validated['dentist_id'],
            'nurse_id' => $validated['nurse_id'],
            'procedure_id' => $validated['procedure_id'],
            'treatment_date' => $validated['treatment_date'],
            'treatment_time' => $validated['treatment_time'],
            
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Appointments has been Created!",
            "data" => $appointment_input
        ], 201);
    }

    /**
     * Retrieve specific appointment using id
     * GET: /api/appointments/{appointment}
     * @param Request
     * @param Appointment
     * @return \Illuminate\Http\Response
     */
    public function appointment_show(Request $request, Appointment $appointment)
    {
        return response()->json([
            "ok" => true,
            "message" => "Appointment Info has been retrieved!",
            "data" => $appointment
        ], 200);
    }

    /**
     * Update specific appointment using inputs from request and id from URI
     * PATCH: /api/appointments/{appointment}
     * @param Request
     * @param Appointment
     * @return \Illuminate\Http\Response
     */
    public function appointment_update(Request $request, Appointment $appointment)
    {
        $validator = validator($request->all(), [
            "name" => "required|string",
            "address" => "required|string",
            "dentist_id" => "exists:dentists,id|required",
            "nurse_id" => "exists:nurses,id|required",
            "procedure_id" => "exists:procedures,id|required",
            "treatment_date" => "required|date",
            "treatment_time" => ["required", new Time],
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();
        $appointment -> update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'dentist_id' => $validated['dentist_id'],
            'nurse_id' => $validated['nurse_id'],
            'procedure_id' => $validated['procedure_id'],
            'treatment_date' => $validated['treatment_date'],
            'treatment_time' => $validated['treatment_time'],
            
        ]);

        return response()->json([
            "ok" => true,
            "message" => "Appointment Info has been Updated!",
            "data" => $appointment
        ], 200);
    }

    /**
     * Delete specific appointment using id from URI
     * DELETE: /api/appointments/{appointment}
     * @param Request
     * @param Appointment
     * @return \Illuminate\Http\Response
     */
    public function appointment_destroy(Request $request, Appointment $appointment)
    {
        $appointment->delete();
        return response()->json([
            "ok" => true,
            "message" => "Appointment has been Deleted!"
        ], 200);
    }
}

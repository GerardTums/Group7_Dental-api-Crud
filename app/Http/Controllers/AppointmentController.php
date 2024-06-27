<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
 /**
     * Retrieve the user info using bearer token
     * GET: /api/checkToken
     * @param Request
     * @return \Illuminate\Http\Response 
     */
    public function appointment_index(Request $request){
        return response()->json([
            "ok" => true,
            "message" => "Appointment Info has been retrieved!",
            
        ], 200);
    }
public function appointment_store(Request $request){
    $validator = validator($request->all(), [
        "dentist_id"=>"exists:dentists,id|required",
        "nurse_id"=>"exists:nurses,id|required",
        "user_id"=>"exists:users,id|required",
        "procedure_id"=>"exists:procedures,id|required",
        "treatment_date" => "required|date",
        "treatment_time" => "required|time",
        "rescedule" => "sometimes|date"
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);
    }

   $validated = $validator->validated();

   $appointment_input = Appointment::create([
        'dentist_id'=> $validated['dentist_id'],
        'nurse_id'=> $validated['nurse_id'],
        'user_id'=> $validated['user_id'],
        'procedure_id'=> $validated['procedure_id'],
        'treatment_date'=> $validated['treatment_date'],
        'treatment_time'=> $validated['treatment_time'],
        'reshcedule'=> $validated['rescedule'],
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
public function appointment_show(Request $request, Doctor $appointment){
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
public function appointment_update(Request $request, Doctor $appointment){
    $validator = validator($request->all(), [
        "dentist_id"=>"exists:dentists,id|required",
        "nurse_id"=>"exists:nurses,id|required",
        "user_id"=>"exists:users,id|required",
        "procedure_id"=>"exists:procedures,id|required",
        "treatment_date" => "required|date",
        "treatment_time" => "required|time",
        "rescedule" => "sometimes|date"
    ]);

    if($validator->fails()){
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass the validation.",
            "errors" => $validator->errors()
        ], 400);

       
    }
    
    $validated = $validator->validated();
    $appointment_input = Appointment::create([
        'dentist_id'=> $validated['dentist_id'],
        'nurse_id'=> $validated['nurse_id'],
        'user_id'=> $validated['user_id'],
        'procedure_id'=> $validated['procedure_id'],
        'treatment_date'=> $validated['treatment_date'],
        'treatment_time'=> $validated['treatment_time'],
        'rescedule'=> $validated['rescedule'],
   ]);

    return response()->json([
        "ok" => true,
        "message" => "Appointment Info has been Updated!",
        "data" => $appointment_input
    ], 200);
}
/** 
     * Delete specific appointment using id from URI
     * DELETE: /api/appointments/{appointment}
     * @param Request
     * @param Appointment
     * @return \Illuminate\Http\Response
     */
    public function appointment_destroy(Request $request, Appointment $appointment){
        $appointment->delete();
        return response()->json([
            "ok" => true,
            "message" => "Appointment has been Deleted!"
        ], 200);
    }
}

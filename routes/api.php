<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



Route::post("/register", [App\Http\Controllers\AuthController::class, "register"]);
Route::post("/login", [App\Http\Controllers\AuthController::class, "login"]);
Route::middleware("auth:api")->get("/checkToken", [App\Http\Controllers\AuthController::class, "checkToken"]);

Route::prefix("users")->group(function () {
    Route::get("/", [App\Http\Controllers\UserController::class, "index"]);
    Route::get("/{user}", [App\Http\Controllers\UserController::class, "show"]);
    Route::delete("/{user}", [App\Http\Controllers\UserController::class, "destroy"]);
    Route::patch("/{user}", [App\Http\Controllers\UserController::class, "update"]);
    Route::post("/", [App\Http\Controllers\UserController::class, "store"]);
});

Route::prefix("appointments")->group(function (){
    Route::get("/", [App\Http\Controllers\AppointmentController::class, "appointment_index"]);
    Route::get("/{appointment}", [App\Http\Controllers\AppointmentController::class, "appointment_show"]);
    Route::delete("/{appoitment}", [App\Http\Controllers\AppointmentController::class, "appointment_destroy"]);
    Route::patch("/{appointment}", [App\Http\Controllers\AppointmentController::class, "appointment_update"]);
    Route::post("/", [App\Http\Controllers\AppointmentController::class, "appointment_store"]);
});

Route::prefix("dentists")->group(function (){
    Route::get("/", [App\Http\Controllers\DentistController::class, "dentist_index"]);
    Route::get("/{dentist}", [App\Http\Controllers\DentistController::class, "dentist_show"]);
    Route::delete("/{dentist}", [App\Http\Controllers\DentistController::class, "dentist_destroy"]);
    Route::patch("/{dentist}", [App\Http\Controllers\DentistController::class, "dentist_update"]);
    Route::post("/", [App\Http\Controllers\DentistController::class, "dentist_store"]);

});
Route::prefix("nurses")->group(function (){
    Route::get("/", [App\Http\Controllers\NurseController::class, "nurse_index"]);
    Route::get("/{nurse}", [App\Http\Controllers\NurseController::class, "nurse_show"]);
    Route::delete("/{nurse}", [App\Http\Controllers\NurseController::class, "nurse_destroy"]);
    Route::patch("/{nurse}", [App\Http\Controllers\NurseController::class, "nurse_update"]);
    Route::post("/", [App\Http\Controllers\NurseController::class, "nurse_store"]);

});
Route::prefix("promos")->group(function (){
    Route::get("/", [App\Http\Controllers\PromoController::class, "promo_index"]);
    Route::get("/{promo}", [App\Http\Controllers\PromoController::class, "promo_show"]);
    Route::delete("/{promo}", [App\Http\Controllers\PromoController::class, "promo_destroy"]);
    Route::patch("/{promo}", [App\Http\Controllers\PromoController::class, "promo_update"]);
    Route::post("/", [App\Http\Controllers\PromoController::class, "promo_store"]);
});
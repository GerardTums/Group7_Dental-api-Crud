<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



Route::post("/register", [App\Http\Controllers\AuthController::class, "register"]);
Route::post("/login", [App\Http\Controllers\AuthController::class, "login"]);
Route::middleware("auth:api")->get("/checkToken", [App\Http\Controllers\AuthController::class, "checkToken"]);

Route::prefix("users")->middleware("auth:api")->group(function () {
    Route::get("/", [App\Http\Controllers\UserController::class, "index"]);
    Route::get("/{user}", [App\Http\Controllers\UserController::class, "show"]);
    Route::delete("/{user}", [App\Http\Controllers\UserController::class, "destroy"]);
    Route::patch("/{user}", [App\Http\Controllers\UserController::class, "update"]);
    Route::post("/", [App\Http\Controllers\UserController::class, "store"]);
});
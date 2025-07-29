<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cars',[CarController::class,'index'])->middleware('auth:sanctum');
Route::get('/cars/{id}',[CarController::class,'show'])->middleware('auth:sanctum');
Route::post('/cars',[CarController::class,'store'])->middleware('auth:sanctum');
Route::put('/cars/{id}',[CarController::class,'update'])->middleware('auth:sanctum');
Route::delete('/cars/{id}',[CarController::class,'destroy'])->middleware('auth:sanctum');

Route::post('/users/signup',[AuthController::class,'signUp']);
Route::post('users/login',[AuthController::class,'login']);
Route::post('users/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

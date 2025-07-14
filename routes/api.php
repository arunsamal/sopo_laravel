<?php

use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cars',[CarController::class,'index'])->middleware('auth:sanctum');
Route::get('/cars/{id}',[CarController::class,'show'])->middleware('auth:sanctum');
Route::post('/cars',[CarController::class,'store'])->middleware('auth:sanctum');
Route::put('/cars/{id}',[CarController::class,'update'])->middleware('auth:sanctum');
Route::delete('/cars/{id}',[CarController::class,'destroy'])->middleware('auth:sanctum');

Route::post('/users/signup',[AuthController::class,'signUp']);
Route::post('users/login',[AuthController::class,'login']);
Route::post('users/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
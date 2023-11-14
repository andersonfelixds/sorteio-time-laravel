<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\UserController;

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
Route::post('sanctum/token', [UserController::class,'authenticate']);
Route::apiResource('user', UserController::class);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


 Route::middleware('auth:sanctum')->group(function(){
     Route::apiResource("diary", DiaryController::class);   
     
     Route::get("/user/me", [UserController::class,'me']);
     Route::patch('/user/change-email',  [UserController::class,'updateEmail']);
     Route::delete('/user/logout',  [UserController::class,'logout']);
     
 });

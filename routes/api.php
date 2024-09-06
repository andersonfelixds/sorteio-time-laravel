<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
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
Route::options('/{any}', function () {
    return response()->json([], 204);
})->where('any', '.*');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['cors'])->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
        
    });
    
    Route::middleware('auth:sanctum')->post('/players', [PlayerController::class, 'store']);
    Route::middleware('auth:sanctum')->get('/players', [PlayerController::class, 'list']);
    Route::middleware('auth:sanctum')->post('/sortear-times', [TimeController::class, 'sortearTimes']);
    Route::middleware('auth:sanctum')->post('/players/confirmar-presenca', [PlayerController::class, 'confirmarPresenca']); 
    Route::middleware('auth:sanctum')->post('/register', [RegisterController::class, 'register']);
    

});

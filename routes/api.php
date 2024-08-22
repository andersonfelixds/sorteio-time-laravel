<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TimeController;
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


Route::apiResource('players', PlayerController::class);
// Rota para adicionar um novo jogador
Route::post('/players', [PlayerController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

// Rota para atualizar um jogador existente
Route::put('/players/{id}', [PlayerController::class, 'update'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

// Rota para confirmar a presença de um jogador
Route::patch('/players/{id}/confirmar-presenca', [PlayerController::class, 'confirmarPresenca'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::post('sortear-times', [TimeController::class, 'sortearTimes'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
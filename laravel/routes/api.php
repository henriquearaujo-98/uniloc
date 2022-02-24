<?php

use App\Http\Controllers\DistritosController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\ProvasIngressoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- Testes ---
// Exames
Route::get('/exames', [ExameController::class, 'index']);
Route::get('/exames/{id}', [ExameController::class, 'show']);
Route::delete('/exames/{id}', [ExameController::class, 'destroy']);
Route::put('/exames/{id}', [ExameController::class, 'update']);
Route::post('/exames', [ExameController::class, 'store']);

// Distritos
Route::get('/distrito', [DistritosController::class, 'index']);
Route::get('/distrito/{id}', [DistritosController::class, 'show']);
Route::post('/distrito', [DistritosController::class, 'store']);
Route::put('/distrito/{id}', [DistritosController::class, 'update']);
Route::delete('/distrito/{id}', [DistritosController::class, 'destroy']);

<?php

use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ProvasIngressoController;
use App\Http\Controllers\DistritosController;
use App\Http\Controllers\Tipo_EnsinoController;
use App\Http\Controllers\Area_EstudoController;
use App\Http\Controllers\ExameController;
use App\Models\Prova_Ingresso;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('tipos_ensino', Tipo_EnsinoController::class);
Route::resource('areas_estudo', Area_EstudoController::class);
Route::resource('distritos', DistritosController::class);
Route::resource('exames', ExameController::class);

Route::get('/cursos/{id}', [InstituicaoController::class, 'cursos']);
Route::get('/provas_ingresso', [ProvasIngressoController::class, 'exames']);


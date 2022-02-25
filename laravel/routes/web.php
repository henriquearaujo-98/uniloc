<?php

use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ProvasIngressoController;
use App\Http\Controllers\DistritosController;
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

Route::get('/cursos/{id}', [InstituicaoController::class, 'cursos']);
Route::get('/provas_ingresso', [ProvasIngressoController::class, 'exames']);
Route::get('/distritos-list', [DistritosController::class, 'index'])->name('distritos.list');
Route::post('/add-distrito', [DistritosController::class, 'addDistrito'])->name('add.distrito');

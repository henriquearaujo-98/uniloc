<?php

use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ProvasIngressoController;
use App\Http\Controllers\DistritosController;
use App\Http\Controllers\Tipo_EnsinoController;
use App\Http\Controllers\Area_EstudoController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\Codigos_PostaisController;
use App\Models\Prova_Ingresso;
use Illuminate\Support\Facades\Route;


Route::resource('tipos_ensino', Tipo_EnsinoController::class);
Route::resource('areas_estudo', Area_EstudoController::class);
Route::resource('distritos', DistritosController::class);
Route::resource('exames', ExameController::class);
Route::resource('cidades', CidadesController::class);
Route::resource('municipios', MunicipiosController::class);
Route::resource('codigos_postais', Codigos_PostaisController::class);
Route::get('/cursos/{id}', [InstituicaoController::class, 'cursos']);
Route::get('/provas_ingresso', [ProvasIngressoController::class, 'exames']);





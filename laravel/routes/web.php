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
use App\Http\Controllers\CursoController;
use App\Http\Controllers\Instituicao_has_CursoController;
use App\Http\Controllers\Informacoes_MunicipioController;
use App\Models\Prova_Ingresso;
use Illuminate\Support\Facades\Route;


Route::resource('tipos_ensino', Tipo_EnsinoController::class);
Route::resource('areas_estudo', Area_EstudoController::class);
Route::resource('distritos', DistritosController::class);
Route::resource('exames', ExameController::class);
Route::resource('cidades', CidadesController::class);
Route::resource('municipios', MunicipiosController::class);
Route::resource('codigos_postais', Codigos_PostaisController::class);
Route::resource('instituicoes', InstituicaoController::class);
Route::resource('cursos', CursoController::class);
Route::resource('inst_cursos', Instituicao_has_CursoController::class);
Route::resource('prova_ingresso', ProvasIngressoController::class);
Route::resource('informacoes', Informacoes_MunicipioController::class);

Route::get('/cursos/{id}', [InstituicaoController::class, 'cursos']);
Route::get('/provas_ingresso', [ProvasIngressoController::class, 'exames']);
// Route::get('/inst_cursos/{curso}/{inst}/edit', ProvasIngressoController::class);

//Route::get('/inst_cursos/edit/{curso}{inst}','Instituicao_has_CursoController@update')->name('inst_cursos.update');
Route::get('/inst_cursos/{cursoID}/{instID}', [Instituicao_has_CursoController::class, 'edit']);
// Route::get('/inst_cursos/{cursoID}/{instID}','Instituicao_has_CursoController@edit')->name('inst_cursos.edit');

route::get('/searchTipo', [Tipo_EnsinoController::class, 'searchTipo']);
route::get('/searchArea', [Area_EstudoController::class, 'searchArea']);





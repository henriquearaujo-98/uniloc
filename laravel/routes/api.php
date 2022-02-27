<?php

use App\Http\Controllers\Area_EstudoController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\Codigos_PostaisController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DistritosController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\Informacoes_MunicipioController;
use App\Http\Controllers\Instituicao_has_CursoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\ProvasIngressoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Tipo_EnsinoController;
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

// Public routes
Route::post('/search', [SearchController::class, 'search']);

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

// Cidades
Route::get('/cidade', [CidadesController::class, 'index']);
Route::post('/cidade', [CidadesController::class, 'store']);
Route::get('/cidade/{id}', [CidadesController::class, 'show']);
Route::put('/cidade/{id}', [CidadesController::class, 'update']);
Route::delete('/cidade/{id}', [CidadesController::class, 'destroy']);

// Municipio
Route::get('/municipio', [MunicipiosController::class, 'index']);
Route::get('/municipio/{id}', [MunicipiosController::class, 'show']);
Route::post('/municipio', [MunicipiosController::class, 'store']);
Route::put('/municipio/{id}', [MunicipiosController::class, 'update']);
Route::delete('/municipio/{id}', [MunicipiosController::class, 'destroy']);

// Codigo Postal
Route::get('/codigo_postal', [Codigos_PostaisController::class, 'index']);
Route::post('/codigo_postal', [Codigos_PostaisController::class, 'store']);
Route::get('/codigo_postal/{id}', [Codigos_PostaisController::class, 'show']);
Route::put('/codigo_postal/{id}', [Codigos_PostaisController::class, 'update']);
Route::delete('/codigo_postal/{id}', [Codigos_PostaisController::class, 'destroy']);

// Tipos de ensino
Route::get('/tipos_ensino', [Tipo_EnsinoController::class, 'index']);
Route::post('/tipos_ensino', [Tipo_EnsinoController::class, 'store']);
Route::get('/tipos_ensino/{id}', [Tipo_EnsinoController::class, 'show']);
Route::put('/tipos_ensino/{id}', [Tipo_EnsinoController::class, 'update']);
Route::delete('/tipos_ensino/{id}', [Tipo_EnsinoController::class, 'destroy']);

// Instituicoes
Route::get('/instituicao', [InstituicaoController::class, 'index']);
Route::post('/instituicao', [InstituicaoController::class, 'store']);
Route::get('/instituicao/{id}', [InstituicaoController::class, 'show']);
Route::put('/instituicao/{id}', [InstituicaoController::class, 'update']);
Route::delete('/instituicao/{id}', [InstituicaoController::class, 'destroy']);

// Area de estudo
Route::get('/area_estudo', [Area_EstudoController::class, 'index']);
Route::post('/area_estudo', [Area_EstudoController::class, 'store']);
Route::get('/area_estudo/{id}', [Area_EstudoController::class, 'show']);
Route::put('/area_estudo/{id}', [Area_EstudoController::class, 'update']);
Route::delete('/area_estudo/{id}', [Area_EstudoController::class, 'destroy']);

// Curso
Route::get('/curso', [CursoController::class, 'index']);
Route::post('/curso', [CursoController::class, 'store']);
Route::get('/curso/{id}', [CursoController::class, 'show']);
Route::put('/curso/{id}', [CursoController::class, 'update']);
Route::delete('/curso/{id}', [CursoController::class, 'destroy']);

// Instituição - Curso
Route::get('/inst_curso', [Instituicao_has_CursoController::class, 'index']);
Route::post('/inst_curso', [Instituicao_has_CursoController::class, 'store']);
Route::get('/inst_curso/{cursoID}/{instID}', [Instituicao_has_CursoController::class, 'show']);
Route::put('/inst_curso/{cursoID}/{instID}', [Instituicao_has_CursoController::class, 'update']);
Route::delete('/inst_curso/{cursoID}/{instID}', [Instituicao_has_CursoController::class, 'destroy']);

// Provas Ingresso
Route::get('/provas', [ProvasIngressoController::class, 'index']);
Route::post('/provas', [ProvasIngressoController::class, 'store']);
Route::get('/provas/{id}', [ProvasIngressoController::class, 'show']);
Route::put('/provas/{id}', [ProvasIngressoController::class, 'update']);
Route::delete('/provas/{id}', [ProvasIngressoController::class, 'destroy']);

// Informações Municipios
Route::get('/inf_municipio', [Informacoes_MunicipioController::class, 'index']);
Route::post('/inf_municipio', [Informacoes_MunicipioController::class, 'store']);
Route::get('/inf_municipio/{id}', [Informacoes_MunicipioController::class, 'show']);
Route::put('/inf_municipio/{id}', [Informacoes_MunicipioController::class, 'update']);
Route::delete('/inf_municipio/{id}', [Informacoes_MunicipioController::class, 'destroy']);

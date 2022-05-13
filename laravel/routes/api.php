<?php


use App\Http\Controllers\API\AreaEstudoController_API;
use App\Http\Controllers\API\CidadesController_API;
use App\Http\Controllers\API\CodigoPostalController_API;
use App\Http\Controllers\API\CursoController_API;
use App\Http\Controllers\API\DistritoController_API;
use App\Http\Controllers\API\ExameController_API;
use App\Http\Controllers\API\InformacoesMunicipioController_API;
use App\Http\Controllers\API\InstituicaoController_API;
use App\Http\Controllers\API\Instituicoes_has_CursoController_API;
use App\Http\Controllers\API\MunicipioController_API;
use App\Http\Controllers\API\ProvaIngressoController_API;
use App\Http\Controllers\API\SearchController_API;
use App\Http\Controllers\API\TipoEnsinoController_API;

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

// --------- Public routes ----------- //
// Search
Route::post('/search', [SearchController_API::class, 'search']);

// Distritos
Route::get('/distritos', [DistritoController_API::class, 'index']);

// Municipios
Route::get('/municipios', [MunicipioController_API::class, 'index']);

// Informação Municipio
Route::get('/informacoes_municipios', [InformacoesMunicipioController_API::class, 'index']);

// Cidades
Route::get('/cidades', [CidadesController_API::class, 'index']);

// Codigos Postais
Route::get('/codigos_postais', [CodigoPostalController_API::class, 'index']);

// Instituições
Route::get('/instituicoes', [InstituicaoController_API::class, 'index']);

// Instituições - Curso
Route::get('/instituicoes_has_curso', [Instituicoes_has_CursoController_API::class, 'index']);
Route::get('/exames_nome', [Instituicoes_has_CursoController_API::class, 'getNomeExames']);

// Curso
Route::get('/cursos', [CursoController_API::class, 'index']);

// Area de estudo
Route::get('/area_estudo', [AreaEstudoController_API::class, 'index']);

// Provas de ingresso
Route::get('/provas_ingresso', [ProvaIngressoController_API::class, 'index']);

// Exames
Route::get('/exames', [ExameController_API::class, 'index']);

// Tipos de ensino
Route::get('/tipos_ensino', [TipoEnsinoController_API::class, 'index']);


// --- Testes ---
// Exames
/*Route::get('/exames', [ExameController_API::class, 'index']);
Route::get('/exames/{id}', [ExameController_API::class, 'show']);
Route::delete('/exames/{id}', [ExameController_API::class, 'destroy']);
Route::put('/exames/{id}', [ExameController_API::class, 'update']);
Route::post('/exames', [ExameController_API::class, 'store']);*/

// Distritos
//Route::get('/distrito', [DistritoController_API::class, 'index']);
//Route::get('/distrito/{id}', [DistritoController_API::class, 'show']);
//Route::post('/distrito', [DistritoController_API::class, 'store']);
//Route::put('/distrito/{id}', [DistritoController_API::class, 'update']);
//Route::delete('/distrito/{id}', [DistritoController_API::class, 'destroy']);

// Cidades
/*Route::get('/cidade', [CidadesController_API::class, 'index']);
Route::post('/cidade', [CidadesController_API::class, 'store']);
Route::get('/cidade/{id}', [CidadesController_API::class, 'show']);
Route::put('/cidade/{id}', [CidadesController_API::class, 'update']);
Route::delete('/cidade/{id}', [CidadesController_API::class, 'destroy']);*/

// Municipio
/*Route::get('/municipio', [MunicipioController_API::class, 'index']);
Route::get('/municipio/{id}', [MunicipioController_API::class, 'show']);
Route::post('/municipio', [MunicipioController_API::class, 'store']);
Route::put('/municipio/{id}', [MunicipioController_API::class, 'update']);
Route::delete('/municipio/{id}', [MunicipioController_API::class, 'destroy']);*/

// Codigo Postal
/*Route::get('/codigo_postal', [CodigoPostalController_API::class, 'index']);
Route::post('/codigo_postal', [CodigoPostalController_API::class, 'store']);
Route::get('/codigo_postal/{id}', [CodigoPostalController_API::class, 'show']);
Route::put('/codigo_postal/{id}', [CodigoPostalController_API::class, 'update']);
Route::delete('/codigo_postal/{id}', [CodigoPostalController_API::class, 'destroy']);*/

// Tipos de ensino
/*Route::get('/tipos_ensino', [TipoEnsinoController_API::class, 'index']);
Route::post('/tipos_ensino', [TipoEnsinoController_API::class, 'store']);
Route::get('/tipos_ensino/{id}', [TipoEnsinoController_API::class, 'show']);
Route::put('/tipos_ensino/{id}', [TipoEnsinoController_API::class, 'update']);
Route::delete('/tipos_ensino/{id}', [TipoEnsinoController_API::class, 'destroy']);*/

// Instituicoes
/*Route::get('/instituicao', [InstituicaoController_API::class, 'index']);
Route::post('/instituicao', [InstituicaoController_API::class, 'store']);
Route::get('/instituicao/{id}', [InstituicaoController_API::class, 'show']);
Route::put('/instituicao/{id}', [InstituicaoController_API::class, 'update']);
Route::delete('/instituicao/{id}', [InstituicaoController_API::class, 'destroy']);*/

// Area de estudo
/*Route::get('/area_estudo', [AreaEstudoController_API::class, 'index']);
Route::post('/area_estudo', [AreaEstudoController_API::class, 'store']);
Route::get('/area_estudo/{id}', [AreaEstudoController_API::class, 'show']);
Route::put('/area_estudo/{id}', [AreaEstudoController_API::class, 'update']);
Route::delete('/area_estudo/{id}', [AreaEstudoController_API::class, 'destroy']);*/

// Curso
/*Route::get('/curso', [CursoController_API::class, 'index']);
Route::post('/curso', [CursoController_API::class, 'store']);
Route::get('/curso/{id}', [CursoController_API::class, 'show']);
Route::put('/curso/{id}', [CursoController_API::class, 'update']);
Route::delete('/curso/{id}', [CursoController_API::class, 'destroy']);*/

// Instituição - Curso
/*Route::get('/inst_curso', [Instituicoes_has_CursoController_API::class, 'index']);
Route::post('/inst_curso', [Instituicoes_has_CursoController_API::class, 'store']);
Route::get('/inst_curso/{cursoID}/{instID}', [Instituicoes_has_CursoController_API::class, 'show']);
Route::put('/inst_curso/{cursoID}/{instID}', [Instituicoes_has_CursoController_API::class, 'update']);
Route::delete('/inst_curso/{cursoID}/{instID}', [Instituicoes_has_CursoController_API::class, 'destroy']);*/

// Provas Ingresso
/*Route::get('/provas', [ProvaIngressoController_API::class, 'index']);
Route::post('/provas', [ProvaIngressoController_API::class, 'store']);
Route::get('/provas/{id}', [ProvaIngressoController_API::class, 'show']);
Route::put('/provas/{id}', [ProvaIngressoController_API::class, 'update']);
Route::delete('/provas/{id}', [ProvaIngressoController_API::class, 'destroy']);*/

// Informações Municipios
/*Route::get('/inf_municipio', [InformacoesMunicipioController_API::class, 'index']);
Route::post('/inf_municipio', [InformacoesMunicipioController_API::class, 'store']);
Route::get('/inf_municipio/{id}', [InformacoesMunicipioController_API::class, 'show']);
Route::put('/inf_municipio/{id}', [InformacoesMunicipioController_API::class, 'update']);
Route::delete('/inf_municipio/{id}', [InformacoesMunicipioController_API::class, 'destroy']);*/

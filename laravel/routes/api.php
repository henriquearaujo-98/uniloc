<?php


use App\Http\Controllers\API\AreaEstudoController_API;
use App\Http\Controllers\API\AuthController_API;
use App\Http\Controllers\API\CidadesController_API;
use App\Http\Controllers\API\CodigoPostalController_API;
use App\Http\Controllers\API\CursoController_API;
use App\Http\Controllers\API\DistritoController_API;
use App\Http\Controllers\API\EmailVerificationController;
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

// Quartos
Route::get('/quartos', [\App\Http\Controllers\API\QuartoController_API::class, 'index']);

//Fotos Quarto
Route::get('/fotos', [\App\Http\Controllers\API\Fotos_QuartoController_API::class, 'index']);

//Comentarios Rating
// ### REVER NOME ### ----
Route::get('/info', [\App\Http\Controllers\API\Comentario_RatingController_API::class, 'index']);


// ## User
Route::post('/register', [AuthController_API::class, 'register']);
Route::post('/login', [AuthController_API::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController_API::class, 'logout']);
    Route::post('/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
});



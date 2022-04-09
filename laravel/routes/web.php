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
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;


Route::resource('tipos_ensino', Tipo_EnsinoController::class)->middleware('auth');
Route::resource('areas_estudo', Area_EstudoController::class)->middleware('auth');
Route::resource('distritos', DistritosController::class)->middleware('auth');
Route::resource('exames', ExameController::class)->middleware('auth');
Route::resource('cidades', CidadesController::class)->middleware('auth');
Route::resource('municipios', MunicipiosController::class)->middleware('auth');
Route::resource('codigos_postais', Codigos_PostaisController::class)->middleware('auth');
Route::resource('instituicoes', InstituicaoController::class)->middleware('auth');
Route::resource('cursos', CursoController::class)->middleware('auth');
Route::resource('inst_cursos', Instituicao_has_CursoController::class)->middleware('auth');
Route::resource('prova_ingresso', ProvasIngressoController::class)->middleware('auth');
Route::resource('informacoes', Informacoes_MunicipioController::class)->middleware('auth');

Route::get('/cursos/{id}', [InstituicaoController::class, 'cursos']);
Route::get('/provas_ingresso', [ProvasIngressoController::class, 'exames']);
// Route::get('/inst_cursos/{curso}/{inst}/edit', ProvasIngressoController::class);

//Route::get('/inst_cursos/edit/{curso}{inst}','Instituicao_has_CursoController@update')->name('inst_cursos.update');
// Route::get('/inst_cursos/{cursoID}/{instID}', [Instituicao_has_CursoController::class, 'edit']);
// Route::get('/inst_cursos/{cursoID}/{instID}','Instituicao_has_CursoController@edit')->name('inst_cursos.edit');


Route::delete('/inst_cursos/destroy/{cursoID}/{instID}','App\Http\Controllers\Instituicao_has_CursoController@destroy')->name('inst_cursos.destroy')->middleware('auth');
Route::get('/inst_cursos/edit/{cursoID}/{instID}','App\Http\Controllers\Instituicao_has_CursoController@edit')->name('inst_cursos.edit')->middleware('auth');
Route::put('/inst_cursos/update/{cursoID}/{instID}','App\Http\Controllers\Instituicao_has_CursoController@update')->name('inst_cursos.update')->middleware('auth');


route::get('/searchTipo', [Tipo_EnsinoController::class, 'searchTipo'])->middleware('auth');
route::get('/searchArea', [Area_EstudoController::class, 'searchArea'])->middleware('auth');
route::get('/searchCidade', [CidadesController::class, 'searchCidade'])->middleware('auth');
route::get('/searchPostal', [Codigos_PostaisController::class, 'searchPostal'])->middleware('auth');
route::get('/searchExame', [ExameController::class, 'searchExame'])->middleware('auth');
route::get('/searchDistrito', [DistritosController::class, 'searchDistrito'])->middleware('auth');
route::get('/searchCurso', [CursoController::class, 'searchCurso'])->middleware('auth');
route::get('/searchInst', [InstituicaoController::class, 'searchInst'])->middleware('auth');
route::get('/searchMunicipio', [MunicipiosController::class, 'searchMunicipio'])->middleware('auth');
route::get('/searchProvas', [ProvasIngressoController::class, 'searchProvas'])->middleware('auth');
route::get('/searchInfo', [Informacoes_MunicipioController::class, 'searchInfo'])->middleware('auth');
route::get('/searchInst_Curso', [Instituicao_has_CursoController::class, 'searchInst_Curso'])->middleware('auth');

route::get('/menu', function(){
    return view('menu');
})->middleware('auth');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

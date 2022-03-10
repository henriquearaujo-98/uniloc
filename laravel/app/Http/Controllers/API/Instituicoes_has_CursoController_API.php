<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Instituicao_has_Curso;
use Illuminate\Http\Request;

class Instituicoes_has_CursoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Instituicao_has_Curso::all();
    }

    public function instituicoes_cursos($curso_id, $inst_id)
    {

        $res = Instituicao_has_Curso::with('instituicao')->with('curso')
            ->where('cursos_ID', $curso_id)
            ->where('instituicoes_ID', $inst_id)
            ->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cursos_ID' => 'required',
            'instituicoes_ID' => 'required',
            'nota_ult_1fase' => 'required',
            //'nota_ult_2fase' => 'optional',
            //'plano_curso' => 'optional',
        ]);

        return Instituicao_has_Curso::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cursoID, $instID)
    {
        return Instituicao_has_Curso::find($cursoID, $instID);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cursoID, $instID)
    {

        if(count(Instituicao_has_Curso::find($cursoID, $instID)))
            return Instituicao_has_Curso::where('cursoS_ID', $cursoID)->where('instituicoes_ID', $instID)->update($request->all());
        else
            return response('Curso da instituição não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cursoID, $instID)
    {
        if(count(Instituicao_has_Curso::find($cursoID, $instID)))
            return Instituicao_has_Curso::where('cursoS_ID', $cursoID)->where('instituicoes_ID', $instID)->delete();
        else
            return response('Curso da instituição não encontrado', 404);
    }
}

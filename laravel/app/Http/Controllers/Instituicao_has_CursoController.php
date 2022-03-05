<?php

namespace App\Http\Controllers;

use App\Models\Instituicao_has_Curso;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Instituicao;

class Instituicao_has_CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inst_cursos = Instituicao_has_Curso::paginate(15);
        return view('inst_cursos.index',compact('inst_cursos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $instituicoes = Instituicao::all();
        return view('inst_cursos.create', compact('cursos', 'instituicoes'));
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
        $validatedData = $request->validate([
            'cursos_ID' => 'required',
            'instituicoes_ID' => 'required',
            'nota_ult_1fase' => 'required',
            'nota_ult_2fase' => 'nullable',
            'plano_curso' => 'nullable',
        ]);

        $show = Instituicao_has_Curso::create($validatedData);
        return redirect('/inst_cursos')->with('success', 'Data is successfully saved');
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
        //return Instituicao_has_Curso::findOrFail($id);
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
//         if(count(Instituicao_has_Curso::find($cursoID, $instID)))
//             return Instituicao_has_Curso::where('cursoS_ID', $cursoID)->where('instituicoes_ID', $instID)->update($request->all());
//         else
//             return response('Curso da instituição não encontrado', 404);

        $validatedData = $request->validate([
            'cursos_ID' => 'required',
            'instituicoes_ID' => 'required',
            'nota_ult_1fase' => 'required',
            'nota_ult_2fase' => 'nullable',
            'plano_curso' => 'nullable',
        ]);

        Instituicao_has_Curso::where('cursos_ID',$cursoID)
                             ->where('instituicoes_ID', $instID)
                             ->update($validatedData);
        return redirect('/inst_cursos')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $inst_curso = Instituicao_has_Curso::findOrFail($id);
        $cursos = Curso::all();
        $instituicoes = Instituicao::all();
        return view('inst_cursos.edit', compact('inst_curso', 'cursos', 'instituicoes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cursoID, $instID)
    {
//         if(count(Instituicao_has_Curso::find($cursoID, $instID)))
//             return Instituicao_has_Curso::where('cursoS_ID', $cursoID)->where('instituicoes_ID', $instID)->delete();
//         else
//             return response('Curso da instituição não encontrado', 404);
        $inst_curso = Instituicao_has_Curso::findOrFail($cursoID, $instID);
        $inst_curso->delete();
        return redirect('/inst_cursos');
    }
}

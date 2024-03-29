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

    public function searchInst_Curso(Request $request){
        $search = $request->get('inst_curso');
        $inst_cursos = Instituicao_has_Curso::join('cursos', 'cursos.ID', '=', 'instituicoes_has_curso.cursos_ID')
                                 ->join('instituicoes', 'instituicoes.ID', '=', 'instituicoes_has_curso.instituicoes_ID')
                                 ->where('instituicoes.nome', 'LIKE', '%'.$search.'%')
                                 ->orWhere('cursos.nome', 'LIKE', '%'.$search.'%')
                                 ->select('instituicoes_has_curso.cursos_ID', 'instituicoes_has_curso.instituicoes_ID'
                                 , 'instituicoes_has_curso.nota_ult_1fase', 'instituicoes_has_curso.nota_ult_2fase',
                                 'instituicoes_has_curso.plano_curso')
                                 ->paginate(15);

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

    public function edit($cursoID, $instID)
    {
        $inst_curso = Instituicao_has_Curso::where('cursos_ID',$cursoID)
                                           ->where('instituicoes_ID', $instID)
                                           ->first();
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
// //         if(count(Instituicao_has_Curso::find($cursoID, $instID)))
// //             return Instituicao_has_Curso::where('cursoS_ID', $cursoID)->where('instituicoes_ID', $instID)->delete();
// //         else
// //             return response('Curso da instituição não encontrado', 404);
//         $inst_curso = Instituicao_has_Curso::where('cursos_ID',$cursoID)
//                                            ->where('instituicoes_ID', $instID);
// //         ::findOrFail($cursoID, $instID);
//         $inst_curso->delete();
//         return redirect('/inst_cursos');

        try{
            $inst_curso = Instituicao_has_Curso::where('cursos_ID',$cursoID)
                                           ->where('instituicoes_ID', $instID);
            $inst_curso->delete();
        } catch (\Exception $exception) {
            return redirect('/inst_cursos')->with('danger', 'Error - Unable to delete record (Foreign Key)');
        }
        return redirect('/inst_cursos')->with('success', 'Data is successfully deleted');
    }
}

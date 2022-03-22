<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use App\Models\Prova_Ingresso;
use App\Models\Curso;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class ProvasIngressoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provas_ingresso = Prova_Ingresso::paginate(15);
        return view('prova_ingresso.index',compact('provas_ingresso'));
    }

    public function searchProvas(Request $request){
        $search = $request->get('provas');
        $provas_ingresso = Prova_Ingresso::join('instituicoes', 'instituicoes.ID', '=', 'provas_ingresso.instituicoes_ID')
                                         ->join('cursos', 'cursos.ID', '=', 'provas_ingresso.cursoID')
                            ->where('instituicoes.nome', 'LIKE', '%'.$search.'%')
                            ->orWhere('cursos.nome', 'LIKE', '%'.$search.'%')
                            ->select('provas_ingresso.ID', 'provas_ingresso.cursoID','provas_ingresso.instituicoes_ID', 'exames_id')
//                             ->toSql();
                            ->paginate(15);

        return view('prova_ingresso.index',compact('provas_ingresso'));
    }

    public function create()
    {
        $instituicoes = Instituicao::all();
        $cursos = Curso::all();
        return view('prova_ingresso.create', compact('cursos','instituicoes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cursoID' => 'required',
            'instituicoes_ID' => 'required',
            'exames_ID' => 'required',
        ]);

        $show = Prova_Ingresso::create($validatedData);
        return redirect('/prova_ingresso')->with('success', 'Data is successfully saved');
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'cursoID' => 'required',
            'instituicoes_ID' => 'required',
            'exames_ID' => 'required',
        ]);

        Prova_Ingresso::whereId($id)->update($validatedData);
        return redirect('/prova_ingresso')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $prova_ingresso = Prova_Ingresso::findOrFail($id);
        $cursos = Curso::all();
        $instituicoes = Instituicao::all();
        return view('prova_ingresso.edit', compact('prova_ingresso', 'cursos', 'instituicoes'));
    }

    public function destroy($id){
        $prova_ingresso = Prova_Ingresso::findOrFail($id);
        $prova_ingresso->delete();
        return redirect('/prova_ingresso');
    }
}

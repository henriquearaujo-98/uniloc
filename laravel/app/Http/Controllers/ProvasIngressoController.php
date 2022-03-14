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

    public function create()
    {
        $instituicoes = Instituicao::all();
        $cursos = Curso::all();
        return view('prova_ingresso.create', compact('cursos','instituicoes'));
    }

        public function searchProvas(Request $request){
            $search = $request->get('provas');
            $provas_ingresso = Prova_Ingresso::join('instituicoes', 'instituicoes.ID', '=', 'provas_ingresso.instituicoes_ID')
                                             ->join('cursos', 'cursos.ID', '=', 'provas_ingresso.cursoID')
                                ->where('instituicoes.nome', 'LIKE', '%'.$search.'%')
                                ->orWhere('cursos.nome', 'LIKE', '%'.$search.'%')
                                ->paginate(15);

            return view('prova_ingresso.index',compact('provas_ingresso'));
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exames($curso_id, $instituicao_id)
    {
        $res = Prova_Ingresso::all()->where('cursoID', $curso_id)->where('instituicoes_ID', $instituicao_id)->first();
        $ids = explode(',', $res->exames_id);
        $nomes = array();
        foreach ($ids as $id){
            array_push($nomes,Exame::all()->where('Codigo',$id));
        }

        return $nomes;
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
            'cursoID' => 'required',
            'instituicoes_ID' => 'required',
            'exames_ID' => 'required',
        ]);

        $show = Prova_Ingresso::create($validatedData);
        return redirect('/prova_ingresso')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Prova_Ingresso::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//         $provas_ingresso = Prova_Ingresso::findOrFail($id);
//         return $provas_ingresso->update($request->all());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prova_ingresso = Prova_Ingresso::findOrFail($id);
        $prova_ingresso->delete();
        return redirect('/prova_ingresso');

    }
}

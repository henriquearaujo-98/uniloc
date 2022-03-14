<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Models\Codigo_Postal;
use App\Models\Tipo_Ensino;
use App\Models\Instituicao_has_Curso;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicoes = Instituicao::paginate(15);
        return view('instituicoes.index',compact('instituicoes'));
    }

    public function create()
    {
        $tipos_ensino = Tipo_Ensino::all();
        $codigos_postais = Codigo_Postal::all();
        return view('instituicoes.create', compact('tipos_ensino', 'codigos_postais'));
    }

    public function searchInst(Request $request){
        $search = $request->get('inst');
        $instituicoes = Instituicao::where('nome', 'LIKE', '%'.$search.'%')
                         ->orWhere('tipos_ensino_ID', 'LIKE', '%'.$search.'%')
                         ->paginate(15);

        return view('instituicoes.index',compact('instituicoes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cursos($inst_id)
    {
        $res = Instituicao_has_Curso::with('instituicao')->with('curso')->where('instituicoes_ID', $inst_id)->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    public function tipos_ensino($tipo_id)
    {

        $res = Instituicao::with('tipos_ensino')->where('tipos_ensino_ID', $tipo_id)->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    public function codigos_postais($codigo_id)
    {

        $res = Instituicao::with('codigos_postais')->where('cod_postal', $codigo_id)->get();

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
            'ID' => 'required',
            'nome' => 'required|unique:instituicoes',
            'tipos_ensino_ID' => 'required',
            'cod_postal' => 'required',
            'rank' => 'nullable',
        ]);
        $show = Instituicao::create($validatedData);
        return redirect('/instituicoes')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Instituicao::find($id);
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
        //$inst = Instituicao::findOrFail($id);
        $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required|unique:instituicoes',
            'tipos_ensino_ID' => 'required',
            'cod_postal' => 'required',
            'rank' => 'nullable',
        ]);

        Instituicao::whereId($id)->update($validatedData);
        return redirect('/instituicoes')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $instituicao = Instituicao::findOrFail($id);
        $codigos_postais = Codigo_Postal::all();
        $tipos_ensino = Tipo_Ensino::all();
        return view('instituicoes.edit', compact('instituicao', 'codigos_postais', 'tipos_ensino'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instituicao = Instituicao::findOrFail($id);
        $instituicao->delete();
        return redirect('/instituicoes');
    }
}

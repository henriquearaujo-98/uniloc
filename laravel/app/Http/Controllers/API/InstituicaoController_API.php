<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Instituicao::all();


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
        $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'tipos_ensino_ID' => 'required',
            'cod_postal' => 'required',
            //'rank' => 'optional'
        ]);
        return Instituicao::create($request->all());
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
        $inst = Instituicao::findOrFail($id);

        $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'tipos_ensino_ID' => 'required',
            'cod_postal' => 'required',
            //'rank' => 'optional'
        ]);

        return $inst->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inst = Instituicao::findOrFail($id);
        return $inst->delete();
    }
}

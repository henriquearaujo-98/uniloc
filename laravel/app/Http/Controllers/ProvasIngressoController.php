<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use App\Models\Prova_Ingresso;
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
        return Prova_Ingresso::all();
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
        $request->validate([
            'cursoID' => 'required',
            'instituicoesID' => 'required',
            'examesID' => 'required',
        ]);

        return Prova_Ingresso::create($request->all());
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
        $provas_ingresso = Prova_Ingresso::findOrFail($id);
        return $provas_ingresso->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provas_ingresso = Prova_Ingresso::findOrFail($id);
        return $provas_ingresso->delete();

    }
}

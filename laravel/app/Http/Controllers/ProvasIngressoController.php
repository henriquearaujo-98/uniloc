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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

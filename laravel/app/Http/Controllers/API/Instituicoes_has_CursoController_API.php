<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exame;
use App\Models\Instituicao_has_Curso;
use App\Models\Prova_Ingresso;
use http\Env\Response;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class Instituicoes_has_CursoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cursoID = $request->get('cursoID');
        $instID = $request->get('instID');

        if(!isset($cursoID) || !isset($instID))
            return Instituicao_has_Curso::all();
        else
            return Instituicao_has_Curso::where('instituicoes_ID', $instID)
                ->where('cursos_ID', $cursoID)
                ->with('instituicao')
                ->with('curso')
                ->with('curso.area_estudo')
                ->with('provas')
                ->with('instituicao.tipo_ensino')
                ->with('instituicao.codigo_postal')
                ->with('instituicao.codigo_postal.cidade')
                ->with('instituicao.codigo_postal.cidade.municipio')
                ->with('instituicao.codigo_postal.cidade.municipio.informacoes')
                ->with('instituicao.codigo_postal.cidade.municipio.distrito')
                ->get();


    }

    public static function  getNomeExames(Request $request){

        $cursoID = $request->get('cursoID');
        $instID = $request->get('instID');

        $exames_id = Prova_Ingresso::where('cursoID', $cursoID)->where('instituicoes_ID', $instID)->get()->pluck('exames_id');

        $exames_nome = Array();

        foreach ($exames_id  as &$item){
           if(str_contains($item, ',')){
               $id_arr = explode (",", $item);
               $temp_arr_nomes = Array();
               foreach ($id_arr as &$id){
                   $nome = Exame::where('ID', intval($id))->get()->pluck('nome');
                   array_push($temp_arr_nomes, $nome[0]);
               }
               array_push($exames_nome, implode(",", $temp_arr_nomes));
           }else{
               $nome = Exame::where('ID', intval($item))->get()->pluck('nome');
               array_push($exames_nome, $nome[0]);
           }
        }

        return $exames_nome;

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
    public function show(Request $request, $cursoID, $instID)
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

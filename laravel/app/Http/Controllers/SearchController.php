<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Codigo_Postal;
use App\Models\Curso;
use App\Models\Instituicao;
use App\Models\Instituicao_has_Curso;
use App\Models\Municipio;
use App\Models\Tipo_Ensino;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $res = array();


        $distritos_id = explode(',', $request->distritos);
        $cidades_id = explode(',',$request->cidade);
        $instituicoes_ids = explode(',',$request->insts);
        $areas_id = explode(',',$request->areas);
        $cursos_ids = explode(',',$request->cursos);
        $tipo_inst = explode(',',$request->tipos_inst);
        $provas = explode(',',$request->provas);
        $nota_min_min = $request->nota_min_min;
        $nota_min_max = $request->nota_min_max;
        $rank_min = $request->rank_min;
        $rank_max = $request->rank_max;


        $inst_cursos = Instituicao_has_Curso::with('instituicao')
            ->with('instituicao.tipo_ensino')
            ->with('instituicao.codigo_postal')
            ->with('instituicao.codigo_postal.cidade')
            ->with('instituicao.codigo_postal.cidade.municipio')
            ->with('instituicao.codigo_postal.cidade.municipio.informacoes')
            ->with('instituicao.codigo_postal.cidade.municipio.distrito')
            ->with('curso')
            ->with('curso.area_estudo')
            ->whereHas('instituicao', function (Builder $query) use ($instituicoes_ids) {

                                                    $query->whereIn('instituicoes_ID', $instituicoes_ids);

                                                })
            ->whereHas('instituicao.tipo_ensino', function (Builder $query) use ($tipo_inst) {

                                                    $query->whereIn('tipos_ensino_ID', $tipo_inst);

                                                })
            ->whereHas('instituicao.codigo_postal', function (Builder $query) use ($cidades_id) {

                                                    $query->whereIn('cidade_ID',$cidades_id);

                                                })
            ->whereHas('instituicao.codigo_postal.cidade.municipio.distrito', function (Builder $query) use ($distritos_id) {

                                                    $query->whereIn('ID', $distritos_id);

                                                })
            ->whereHas('curso', function (Builder $query) use ($cursos_ids){

                                                    $query->whereIn('cursos_ID', $cursos_ids);

                                                })
            ->whereHas('curso.area_estudo', function (Builder $query) use ($areas_id){

                                                    $query->whereIn('ID', $areas_id);

                                                })
            ->get();


        return $inst_cursos;
        //return $inst_cursos[0]['instituicao'][0]['tipos_ensino_ID'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        return $id;
        return $request->all();
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

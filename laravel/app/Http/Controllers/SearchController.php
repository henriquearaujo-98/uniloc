<?php

namespace App\Http\Controllers;

use App\Models\Area_Estudo;
use App\Models\Cidade;
use App\Models\Codigo_Postal;
use App\Models\Curso;
use App\Models\Distrito;
use App\Models\Exame;
use App\Models\Instituicao;
use App\Models\Instituicao_has_Curso;
use App\Models\Municipio;
use App\Models\Prova_Ingresso;
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


        $distritos_id = explode(',', $request->distritos);
        $cidades_id = explode(',',$request->cidade);
        $instituicoes_ids = explode(',',$request->insts);
        $areas_id = explode(',',$request->areas);
        $cursos_ids = explode(',',$request->cursos);
        $tipo_inst = explode(',',$request->tipos_inst);
        $provas_ids = explode(',',$request->provas);
        $nota_min_min = $request->nota_min_min;
        $nota_min_max = $request->nota_min_max;
        $rank_min = $request->rank_min;
        $rank_max = $request->rank_max;


        if(empty($distritos_id[0])){
            $distritos_id = Distrito::all()->pluck('ID');
        }

        if(empty($cidades_id[0])){
            $cidades_id = Cidade::all()->pluck('ID');
        }

        if(empty($instituicoes_ids[0])){
            $instituicoes_ids = Instituicao::all()->pluck('ID');
        }

        if(empty($areas_id[0])){
            $areas_id = Area_Estudo::all()->pluck('ID');
        }

        if(empty($cursos_ids[0])){
            $cursos_ids = Curso::all()->pluck('ID');
        }

        if(empty($tipo_inst[0])){
            $tipo_inst = Tipo_Ensino::all()->pluck('ID');
        }

        if(empty($provas_ids[0])){
            $provas_ids = Exame::all()->pluck('Codigo');
        }




        //return Prova_Ingresso::with('exames')->get();
        $inst_cursos = Instituicao_has_Curso::whereBetween('nota_ult_1fase', [intval($nota_min_min), intval($nota_min_max)])
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
            ->whereHas('instituicao', function (Builder $query) use ($rank_max, $rank_min, $instituicoes_ids) {

                                                    if(intval($rank_min) != null && intval($rank_max) != null)
                                                        $query->whereIn('ID', $instituicoes_ids)->whereBetween('rank', [intval($rank_min), intval($rank_max)]);
                                                    else
                                                        $query->whereIn('ID', $instituicoes_ids);

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
            ->whereHas('provas', function (Builder $query) use ($provas_ids) {

                                                    $query->where('exames_id', 'LIKE', '%'.$provas_ids[0].'%');
                                                    if(count($provas_ids) > 1){
                                                        for($i = 1; $i < count($provas_ids); $i++){
                                                            $query->orWhere('exames_id', 'LIKE', '%'.$provas_ids[$i].'%');
                                                        }
                                                    }


                                                });



        return $inst_cursos->get();

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

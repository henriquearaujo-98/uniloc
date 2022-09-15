<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informacoes_Municipio;
use Illuminate\Http\Request;

class InformacoesMunicipioController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return cache()->remember('info_mun', 60*60*365, function(){
            return Informacoes_Municipio::all();
        });

    }


    public function municipio($municipio_id)
    {

        $res = Informacoes_Municipio::with('municipios')->where('municipio_ID', $municipio_id)->get();

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
        return $request->all();
        return Informacoes_Municipio::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Informacoes_Municipio::find($id);
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
        $array_keys = array_keys($request->all());      // O pedido API substitui os espaços por underscores. Temos que reverter isso.
        foreach ($array_keys as $array_key) {

            if($array_key == 'municipio_ID')
                continue;

            $request[str_replace("_", " ", $array_key)] = $request[$array_key];
            unset($request[$array_key]);
        }

        $inf = Informacoes_Municipio::findOrFail($id);
        return $inf->update($request->all());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inf_mun = Informacoes_Municipio::find($id);
        return $inf_mun->delete();
    }
}

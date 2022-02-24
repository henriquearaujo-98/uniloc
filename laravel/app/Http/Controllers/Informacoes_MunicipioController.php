<?php


namespace App\Http\Controllers;


use App\Models\Informacoes_Municipio;
use App\Models\Municipio;

class Informacoes_MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Informacoes_Municipio::all();
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
        $inf_mun = Informacoes_Municipio::find($id);
        return $inf_mun->update($request->all());
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

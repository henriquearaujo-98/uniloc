<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadesController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Cidade::with('municipio')->get();
        $new = [];

        foreach ($res as $item){
            $cidade_nome = $item['nome'];
            $municipio_nome = $item['municipio']['nome'];
            $item['nome'] = $cidade_nome.' ('.$municipio_nome.')';
            $obj = [
                'ID' => $item['ID'],
                'nome' => $item['nome']
            ];
            array_push($new,$obj);
        }

        return $new;


    }


    public function municipios($municipio_id)
    {

        $res = Cidade::with('municipios')->where('municipios_ID', $municipio_id)->get();

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
            'municipio_ID' => 'required',
        ]);

        return Cidade::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cidade::findOrFail($id);
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
        $cidade = Cidade::findOrFail($id);

        $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'municipio_ID' => 'required',
        ]);

        return $cidade->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cidade = Cidade::findOrFail($id);
        return $cidade->delete();
    }
}

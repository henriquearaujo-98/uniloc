<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fotos_Quarto;
use Illuminate\Http\Request;

class Fotos_QuartoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Fotos_Quarto::with('quarto')->get();
        $new = [];

        //TODO
        /*
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
        */

        return $new;
    }


    public function quarto($quarto_id)
    {
        $res = Fotos_Quarto::with('quarto')->where('quartoID', $quarto_id)->get();

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
            'id'=> 'required',
            'PATH'=> 'required',
            'Name'=> 'required',
            'quartoID' => 'required',
        ]);

        return Fotos_Quarto::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Fotos_Quarto::findOrFail($id);
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
        $fotos_quarto = Fotos_Quarto::findOrFail($id);

        $request->validate([
            'id'=> 'required',
            'PATH'=> 'required',
            'Name'=> 'required',
            'quartoID' => 'required',
        ]);

        return $fotos_quarto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fotos_quarto = Fotos_Quarto::findOrFail($id);
        return $fotos_quarto->delete();
    }
}

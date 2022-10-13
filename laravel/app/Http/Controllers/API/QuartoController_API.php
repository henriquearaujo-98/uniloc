<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quarto::all();
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
            'id' => 'required',
            'descricao' => 'required',
            'MetrosQuadrados' => 'required',
            'Preco' => 'required',
            'municipioID' => 'required',
            'CasaBanhoPrivada',
            'Recibos',
            'Sexo',
            'NViews',
            'userID'
        ]);

        return Quarto::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Quarto::findOrFail($id);
    }

    public function users($userID)
    {
        $res = Quarto::with('userID')->where('userID', $userID)->get();

        return view('welcome', [
            'posts' => $res
        ]);
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
        $quarto = Quarto::findOrFail($id);

        $request->validate([
            'id' => 'required',
            'descricao' => 'required',
            'MetrosQuadrados' => 'required',
            'Preco' => 'required',
            'municipioID' => 'required',
            'CasaBanhoPrivada',
            'Recibos',
            'Sexo',
            'NViews',
            'userID'
        ]);

        return $quarto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quarto = Quarto::findOrFail($id);
        return $quarto->delete();
    }
}

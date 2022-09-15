<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tipo_Ensino;
use Illuminate\Http\Request;

class TipoEnsinoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return cache()->remember('tipos_ensino', 60*60*365, function(){
            return Tipo_Ensino::all();
        });

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
        ]);

        return Tipo_Ensino::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tipo_Ensino::findOrFail($id);
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
        $tipo_ensino = Tipo_Ensino::findOrFail($id);

        $request->validate([
            'ID' => 'required',
            'nome' => 'required',
        ]);

        $tipo_ensino->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_ensino = Tipo_Ensino::findOrFail($id);
        $tipo_ensino->delete();
    }
}

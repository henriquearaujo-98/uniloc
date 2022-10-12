<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fotos_Quarto;
use Faker\Provider\Address;
use Illuminate\Http\Request;

class Fotos_QuartoController_API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quartoID = $request->get('quartoID');

        if(!isset($quartoID))
            $res = Fotos_Quarto::all();
        else
            $res = Fotos_Quarto::where('quartoID', $quartoID)
                ->get();

        return $res;
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

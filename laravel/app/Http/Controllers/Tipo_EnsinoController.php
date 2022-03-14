<?php


namespace App\Http\Controllers;


use App\Models\Curso;
use App\Models\Instituicao_has_Curso;
use App\Models\Tipo_Ensino;
use Illuminate\Http\Request;

class Tipo_EnsinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_ensino = Tipo_Ensino::all();
        return view('tipos_ensino.index',compact('tipos_ensino'));
    }

    public function create()
    {
        return view('tipos_ensino.create');
    }

    public function searchTipo(Request $request){
        $search = $request->get('tipo');
        $tipos_ensino = Tipo_Ensino::where('nome', 'LIKE', '%'.$search.'%')->get();
        return view('tipos_ensino.index',compact('tipos_ensino'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required|unique:tipos_ensino',
        ]);

         $show = Tipo_Ensino::create($validatedData);
         return redirect('/tipos_ensino')->with('success', 'Data is successfully saved');
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

    public function edit($id)
    {
        $tipo_ensino = Tipo_Ensino::findOrFail($id);
        return view('tipos_ensino.edit', compact('tipo_ensino'));
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
        $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required|unique:tipos_ensino',
        ]);

         Tipo_Ensino::whereId($id)->update($validatedData);
         return redirect('/tipos_ensino')->with('success', 'Data is successfully updated');
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

        return redirect('/tipos_ensino');
    }
}

<?php


namespace App\Http\Controllers;

use App\Models\Exame;
use Illuminate\Http\Request;

class ExameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exames = Exame::all();
        return view('exames.index',compact('exames'));
    }

    public function create()
    {
        return view('exames.create');
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
            'Codigo' => 'required',
            'Nome' => 'required',
        ]);
        $show = Exame::create($validatedData);
        return redirect('/exames')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Exame::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigo)
    {
        $validatedData = $request->validate([
            'Codigo' => 'required',
            'Nome' => 'required',
        ]);
         Exame::whereCodigo($codigo)->update($validatedData);
         return redirect('/exames')->with('success', 'Data is successfully updated');
    }

    public function edit($codigo)
    {
        $exame = Exame::findOrFail($codigo);
        return view('exames.edit', compact('exame'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exame = Exame::findOrFail($id);
        $exame->delete();
        return redirect('/exames');
    }
}

<?php


namespace App\Http\Controllers;


use App\Models\Area_Estudo;
use Illuminate\Http\Request;

class Area_EstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas_estudo = Area_Estudo::all();
        return view('areas_estudo.index',compact('areas_estudo'));
    }

    public function create()
    {
        return view('areas_estudo.create');
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
            'nome' => 'required|unique:areas_estudo',
        ]);

        $show = Area_Estudo::create($validatedData);
        return redirect('/areas_estudo')->with('success', 'Data is successfully saved');
    }

    public function searchArea(Request $request){
        $search = $request->get('area');
        $areas_estudo = Area_Estudo::where('nome', 'LIKE', '%'.$search.'%')->get();
        return view('areas_estudo.index',compact('areas_estudo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Area_Estudo::findOrFail($id);
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
            'nome' => 'required|unique:areas_estudo',
        ]);

         Area_Estudo::whereId($id)->update($validatedData);
         return redirect('/areas_estudo')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $area_estudo = Area_Estudo::findOrFail($id);
        return view('areas_estudo.edit', compact('area_estudo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area_estudo = Area_Estudo::findOrFail($id);
        $area_estudo->delete();
        return redirect('/areas_estudo');
    }
}

<?php


namespace App\Http\Controllers;


use App\Models\Instituicao;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipiosController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::paginate(15);
        return view('municipios.index',compact('municipios'));
    }

    public function create()
    {
        return view('municipios.create');
    }

    public function distritos($distrito_id)
    {
        $res = Municipio::with('distritos')->where('distritos_ID', $distrito_id)->get();

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
        $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'distritos_ID' => 'required',
        ]);
        $show = Municipio::create($validatedData);
        return redirect('/municipios')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Municipio::findOrFail($id);
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
            'nome' => 'required',
            'distritos_ID' => 'required',
        ]);

         Municipio::whereId($id)->update($validatedData);
         return redirect('/municipios')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $municipio = Municipio::findOrFail($id);
        return view('municipios.edit', compact('municipio'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();
        return redirect('/municipios');
    }
}

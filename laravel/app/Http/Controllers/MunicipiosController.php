<?php


namespace App\Http\Controllers;


use App\Models\Instituicao;
use App\Models\Municipio;
use App\Models\Distrito;
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

    public function searchMunicipio(Request $request){
        $search = $request->get('municipio');
        $municipios = Municipio::where('nome', 'LIKE', '%'.$search.'%')
                         ->orWhere('distritos_ID', 'LIKE', '%'.$search.'%')
                         ->paginate(15);

        return view('municipios.index',compact('municipios'));
    }

    public function create()
    {
        $distritos = Distrito::all();
        return view('municipios.create', compact('distritos'));
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
            'nome' => 'required|unique:municipios',
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
            'nome' => 'required|unique:municipios',
            'distritos_ID' => 'required',
        ]);

         Municipio::whereId($id)->update($validatedData);
         return redirect('/municipios')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $municipio = Municipio::findOrFail($id);
        $distritos = Distrito::all();
        return view('municipios.edit', compact('municipio', 'distritos'));
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

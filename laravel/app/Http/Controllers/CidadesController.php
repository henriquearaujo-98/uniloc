<?php


namespace App\Http\Controllers;


use App\Models\Cidade;
use App\Models\Municipio;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::paginate(15);
        return view('cidades.index',compact('cidades'));
    }

   public function create()
    {
        $municipios = Municipio::all();
        return view('cidades.create', compact('municipios'));
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
         $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'municipio_ID' => 'required',
        ]);

        $show = Cidade::create($validatedData);
        return redirect('/cidades')->with('success', 'Data is successfully saved');
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
//         $cidade = Cidade::findOrFail($id);
         $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required',
            'municipio_ID' => 'required',
        ]);

         Cidade::whereId($id)->update($validatedData);
         return redirect('/cidades')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $cidade = Cidade::findOrFail($id);
        $municipios = Municipio::all();
        return view('cidades.edit', compact('cidade', 'municipios'));
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
        $cidade->delete();
        return redirect('/cidades');
    }
}

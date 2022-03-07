<?php


namespace App\Http\Controllers;


use App\Models\Codigo_Postal;
use App\Models\Municipio;
use App\Models\Cidade;
use Illuminate\Http\Request;

class Codigos_PostaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigos_postais = Codigo_Postal::paginate(15);
        return view('codigos_postais.index',compact('codigos_postais'));
    }

    public function create()
    {
        $cidades = Cidade::all();
        return view('codigos_postais.create', compact('cidades'));
    }

    public function cidades($cidade_id)
    {
        $res = Codigo_Postal::with('cidades')->where('cidades_ID', $cidade_id)->get();

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
            'cod_postal' => 'required',
            'cidade_ID' => 'required',
        ]);

        $show = Codigo_Postal::create($validatedData);
        return redirect('/codigos_postais')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Codigo_Postal::findOrFail($id);
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
        //$cod = $this->show($id);
        $validatedData = $request->validate([
            'cod_postal' => 'required',
            'cidade_ID' => 'required',
        ]);

        //return $cod->update($request->all());

        Codigo_Postal::wherecod_postal($id)->update($validatedData);
        return redirect('/codigos_postais')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $codigo_postal = Codigo_Postal::findOrFail($id);
        $cidades = Cidade::all();
        return view('codigos_postais.edit', compact('codigo_postal', 'cidades'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $codigo_postal = Codigo_Postal::findOrFail($id);
        $codigo_postal->delete();
        return redirect('/codigos_postais');
    }
}

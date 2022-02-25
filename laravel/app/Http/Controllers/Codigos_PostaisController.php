<?php


namespace App\Http\Controllers;


use App\Models\Codigo_Postal;
use App\Models\Municipio;
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
        return Codigo_Postal::all();
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
        $request->validate([
            'cod_postal' => 'required',
            'cidade_ID' => 'required',
        ]);

        return Codigo_Postal::create($request->all());
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
        $cod = $this->show($id);

        $request->validate([
            'cod_postal' => 'required',
            'cidade_ID' => 'required',
        ]);

        return $cod->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cod = $this->show($id);
        return $cod->delete();
    }
}

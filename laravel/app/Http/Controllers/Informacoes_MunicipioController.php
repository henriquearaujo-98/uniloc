<?php


namespace App\Http\Controllers;


use App\Models\Informacoes_Municipio;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Informacoes_MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informacoes = Informacoes_Municipio::paginate(15);
        return view('informacoes.index',compact('informacoes'));
    }

    public function create()
    {
        $municipios = Municipio::all();
        return view('informacoes.create', compact('municipios'));
    }

    public function municipio($municipio_id)
    {
        $res = Informacoes_Municipio::with('municipios')->where('municipio_ID', $municipio_id)->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    public function searchInfo(Request $request){
        $search = $request->get('info');
        $informacoes = Informacoes_Municipio::join('municipios', 'municipios.ID', '=', 'informacoes_municipios.municipio_ID')
                                            ->where('municipios.nome', 'LIKE', '%'.$search.'%')
                                            ->paginate(15);

        return view('informacoes.index',compact('informacoes'));
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
                'municipio_ID' => 'required',
                'População residente' => 'nullable',
                'Densidade populacional' => 'nullable',
                'Mulheres (%)' => 'nullable',
                'Homens (%)' => 'nullable',
                'Jovens (%)' => 'nullable',
                'População em idade activa (%)' => 'nullable',
                'Idosos (%)' => 'nullable',
                'Índice de envelhecimento' => 'nullable',
                'Indivíduos em idade activa por idoso' => 'nullable',
                'Solteiros (%)' => 'nullable',
                'Casados (%)' => 'nullable',
                'Divorciados (%)' => 'nullable',
                'Viúvos (%)' => 'nullable',
                'Famílias' => 'nullable',
                'Famílias unipessoais (%)' => 'nullable',
                'Famílias com 2 pessoas (%)' => 'nullable',
                'Alojamentos' => 'nullable',
                'Alojamentos familiares clássicos (%)' => 'nullable',
                'Alojamentos colectivos (%)' => 'nullable',
                'Alojamentos ocupados (%)' => 'nullable',
                'Alojamentos próprios (%)' => 'nullable',
                'Alojamentos próprios com encargos de compra (%)' => 'nullable',
                'Alojamentos arrendados e outros casos (%)' => 'nullable',
                'Renda mensal: <50€' => 'nullable',
                'Renda mensal: 50€ - 99,99€' => 'nullable',
                'Renda mensal: 100€ - 199,99€' => 'nullable',
                'Renda mensal: 200€ - 399,99€' => 'nullable',
                'Renda mensal: 400€ - 649,99€' => 'nullable',
                'Renda mensal: 650€ - 999,99€' => 'nullable',
                'Renda mensal: >=1000€' => 'nullable',
                'Edificios' => 'nullable',
            ]);

//         return $request->all();
        $show = Informacoes_Municipio::create($validatedData);
        return redirect('/informacoes')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Informacoes_Municipio::find($id);
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
//         $array_keys = array_keys($request->all());      // O pedido API substitui os espaços por underscores. Temos que reverter isso.
//         foreach ($array_keys as $array_key) {
//
//             if($array_key == 'municipio_ID')
//                 continue;
//
//             $request[str_replace("_", " ", $array_key)] = $request[$array_key];
//             unset($request[$array_key]);
//         }

//         $inf = Informacoes_Municipio::findOrFail($id);
//         return $inf->update($request->all());

        $validatedData = $request->validate([
            'municipio_ID' => 'required',
            'População residente' => 'nullable',
            'Densidade populacional' => 'nullable',
            'Mulheres (%)' => 'nullable',
            'Homens (%)' => 'nullable',
            'Jovens (%)' => 'nullable',
            'População em idade activa (%)' => 'nullable',
            'Idosos (%)' => 'nullable',
            'Índice de envelhecimento' => 'nullable',
            'Indivíduos em idade activa por idoso' => 'nullable',
            'Solteiros (%)' => 'nullable',
            'Casados (%)' => 'nullable',
            'Divorciados (%)' => 'nullable',
            'Viúvos (%)' => 'nullable',
            'Famílias' => 'nullable',
            'Famílias unipessoais (%)' => 'nullable',
            'Famílias com 2 pessoas (%)' => 'nullable',
            'Alojamentos' => 'nullable',
            'Alojamentos familiares clássicos (%)' => 'nullable',
            'Alojamentos colectivos (%)' => 'nullable',
            'Alojamentos ocupados (%)' => 'nullable',
            'Alojamentos próprios (%)' => 'nullable',
            'Alojamentos próprios com encargos de compra (%)' => 'nullable',
            'Alojamentos arrendados e outros casos (%)' => 'nullable',
            'Renda mensal: <50€' => 'nullable',
            'Renda mensal: 50€ - 99,99€' => 'nullable',
            'Renda mensal: 100€ - 199,99€' => 'nullable',
            'Renda mensal: 200€ - 399,99€' => 'nullable',
            'Renda mensal: 400€ - 649,99€' => 'nullable',
            'Renda mensal: 650€ - 999,99€' => 'nullable',
            'Renda mensal: >=1000€' => 'nullable',
            'Edificios' => 'nullable',
        ]);

        Informacoes_Municipio::whereId($id)->update($validatedData);
        return redirect('/informacoes')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $informacao = Informacoes_Municipio::findOrFail($id);
        $municipios = Municipio::all();
        return view('informacoes.edit', compact('informacao', 'municipios'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inf_mun = Informacoes_Municipio::findOrFail($id);
        $inf_mun->delete();
        return redirect('/informacoes');
    }
}

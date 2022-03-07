<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Instituicao_has_Curso;
use Illuminate\Http\Request;
use App\Models\Area_Estudo;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::paginate(15);
        return view('cursos.index',compact('cursos'));
    }

    public function create()
    {
        $areas_estudo = Area_Estudo::all();
        return view('cursos.create', compact('areas_estudo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function instituicoes($curso_id)
    {
        $res = Instituicao_has_Curso::with('instituicao')->with('curso')->where('cursos_ID', $curso_id)->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    public function areas_estudo($area_id)
    {
        $res = Curso::with('area_curso_ID')->where('area_curso_ID', $area_id)->get();

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
            'area_curso_ID' => 'required',
        ]);
        $show = Curso::create($validatedData);
        return redirect('/cursos')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Curso::findOrFail($id);
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
            'area_curso_ID' => 'required',
        ]);

         Curso::whereId($id)->update($validatedData);
         return redirect('/cursos')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $areas_estudo = Area_Estudo::all();
        return view('cursos.edit', compact('curso', 'areas_estudo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect('/cursos');
    }
}

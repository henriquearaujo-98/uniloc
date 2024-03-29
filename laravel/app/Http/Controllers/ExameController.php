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

    public function searchExame(Request $request){
        $search = $request->get('exame');
        $exames = Exame::where('nome', 'LIKE', '%'.$search.'%')->get();

        return view('exames.index',compact('exames'));
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ID' => 'required',
            'nome' => 'required',
        ]);
         Exame::whereId($id)->update($validatedData);
         return redirect('/exames')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $exame = Exame::findOrFail($id);
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
        try{
            $exame = Exame::findOrFail($id);
            $exame->delete();
        } catch (\Exception $exception) {
            return redirect('/exames')->with('danger', 'Error - Unable to delete record (Foreign Key)');
        }
        return redirect('/exames')->with('success', 'Data is successfully deleted');
    }
}

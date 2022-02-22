<?php


namespace App\Http\Controllers;


use App\Models\Distrito;
use http\Env\Request;
use http\Env\Response;

class DistritosController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('distritos-list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'nome' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $distrito = new Distrito();
            $distrito->Nome = $request->distrito_nome;
            $query = $distrito->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Distrito adicionado com sucesso']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function GetDistritosList()
    {
        $distritos = Distrito::all();
        return DataTables::of($distritos)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                return '<div class="btn-group">
                            <button class="btn btn-sm btn-primary" data-id="'.$row['id'].'"
                            id="editDistritosButton">Update</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    //Get detalhes Distritos
    public function getDistritosDetails(Request $request){
        $distrito_id = $request->distrito_id;
        $distrito_details = Distrito::find($distrito_id);
        return response()->json(['details'=>$distrito_details]);
    }

    //Update
    public function updateDistritoDetails(Request $request){
        $distrito_id = $request->cid;

        $validator = \Validator::make($request->all(),[
            'nome'=>'required'.$distrito_id,
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $distrito = Distrito::find($distrito_id);
            $distrito->nome = $request->nome;
            $query = $distrito->save();

            if($query){
                return response()->json(['code'=>1, 'msg'=>'Distrito have Been updated']);
            }else{
                return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
            }
        }
    }


    // DELETE COUNTRY RECORD
    public function deleteDistrito(Request $request){
        $distrito_id = $request->distrito_id;
        $query = Distrito::find($distrito_id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Distrito has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }


    public function deleteSelecteddistritos(Request $request){
        $distrito_ids = $request->distrito_ids;
        Distrito::whereIn('id', $distrito_ids)->delete();
        return response()->json(['code'=>1, 'msg'=>'Distritos have been deleted from database']);
    }
}

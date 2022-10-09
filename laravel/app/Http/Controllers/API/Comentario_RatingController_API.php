<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comentario_Rating;
use Illuminate\Http\Request;

class Comentario_RatingController_API extends Controller
{
    //public function index()
    //{
    //   return Comentario_Rating::all();
    //}

    public function index(Request $request)
    {
        $quartoID = $request->get('quartoID');
        $userID = $request->get('userID');

        if(!isset($quartoID) || !isset($userID))
            $res = Comentario_Rating::all();
        else
            $res = Comentario_Rating::where('quartoID', $quartoID)
                ->where('userID', $userID)
                ->get();

        return $res;
    }

    public function comentarios_rating($quartoID, $userID)
    {

        $res = Comentario_Rating::with('quartos')->with('user')
            ->where('userID', $userID)
            ->where('quartoID', $quartoID)
            ->get();

        return view('welcome', [
            'posts' => $res
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'Comentario',
            'Rating',
            'NViews',
            'quartoID' => 'required',
            'userID' => 'required',
        ]);
        return Comentario_Rating::create($request->all());
    }

    public function show($id)
    {
        return Comentario_Rating::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $comentario_rating = Comentario_Rating::findOrFail($id);
        return $comentario_rating->update($request->all());
    }


    /*
     * Fiz desta maneira porque a PK é um id
     */
    public function destroy($id)
    {
        $comentario_rating = Comentario_Rating::findOrFail($id);
        return $comentario_rating->delete();
    }
}

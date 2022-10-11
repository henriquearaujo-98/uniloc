<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function PHPUnit\Framework\isEmpty;

class UserController_API extends Controller
{
    public function index()
    {
        return User::with('instituicao')->with('curso')->get();
    }

    public function show($id)
    {
        $res = User::with('instituicao')->with('curso')->where('ID','=',$id)->get();
        if(count($res) === 0)
            return response('404 not found', 404);

        return $res;
    }

    public function update(Request $request, $id)
    {

        $authID = auth('sanctum')->user()->id;

        if($id != $authID)
            return response('Forbiden', 403);


        if(User::whereId($id)->update($request->all()))
            return User::with('curso')->with('instituicao')->whereId($id)->get();

    }
}

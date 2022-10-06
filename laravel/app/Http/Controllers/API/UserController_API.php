<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController_API extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $authID = auth('sanctum')->user()->id;

        if($id != $authID)
            return response('Forbiden', 403);

        return User::whereId($id)->update($request->all());

    }
}

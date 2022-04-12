<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
        } catch (\Exception $exception) {
            return redirect('/users')->with('danger', 'Error - Unable to delete record');
        }
        return redirect('/users')->with('success', 'Data is successfully deleted');
    }
}

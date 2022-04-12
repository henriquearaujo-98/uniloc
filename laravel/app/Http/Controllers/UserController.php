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

    public function create()
    {
        return view('users.create');
    }

    public function searchUser(Request $request){
        $search = $request->get('user');
        $users = User::where('name', 'LIKE', '%'.$search.'%')
                     ->orWhere('email', 'LIKE', '%'.$search.'%')->get();

        return view('users.index',compact('users'));
    }

    public function store(Request $request)
     {
         $validatedData = $request->validate([
               'name' => 'required',
               'email' => 'required|email|unique:users',
               'password' => [
                           'required',
                           'string',
                           'min:10',             // must be at least 10 characters in length
                           'regex:/[a-z]/',      // must contain at least one lowercase letter
                           'regex:/[A-Z]/',      // must contain at least one uppercase letter
                           'regex:/[0-9]/',      // must contain at least one digit
                           'regex:/[@$!%*#?&_-]/', // must contain a special character
               ]
         ]);

         $show = User::create($validatedData);
         return redirect('/users')->with('success', 'Data is successfully saved');
     }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        User::whereId($id)->update($validatedData);
        return redirect('/users')->with('success', 'Data is successfully updated');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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

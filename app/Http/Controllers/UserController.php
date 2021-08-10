<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role'); //just the admin
    }

    public function index()
    {
        $users = User::all();
        return view('users', ['listautenti' => $users]);
    }

    public function save(Request $request)
    {
        //validate
        /*request()->validate([
           'role' => 'required|max:10',
           'email' => 'required|max:255',
           'password'=> 'required|min:8|max:255',
           'nome' => 'required|email|max:255',
           'cognome' => 'required|max:255',
        ]);*/
        echo $request;
        $user = new User;
        $user->is_admin = ($request->input('role') === "admin");
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->nome = $request->input('nome');
        $user->cognome = $request->input('cognome');
        $user->save();
        return redirect()->route('user');
    }


}

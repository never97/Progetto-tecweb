<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return view('user.index', ['listautenti' => $users]);
    }
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }
    public function show(User $user)
    {
        //
    }
    public function update(Request $request, User $user) {
        $user->nome = $request->input('nome');
        $user->cognome = $request->input('cognome');
        $user->is_admin = ($request->input('role') === "admin");
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/user');
    }
    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();
        return json_encode(['status' => 'ok']);
    }

    public function store(Request $request)
    {
        //validate
        $validator = Validator::make($request->all(), [

            //request()->validate([
            'role' => 'required',
            'email' => 'required|email|max:60|unique:users,email',
            'password'=> 'required|min:8|max:50',
            'nome' => 'required|min:2|max:50',
            'cognome' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            //echo $request;
            $user = new User;
            $user->is_admin = ($request->input('role') === "admin");
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->nome = $request->input('nome');
            $user->cognome = $request->input('cognome');
            $user->save();
            return redirect()->route('user.index');
        }

    }


}
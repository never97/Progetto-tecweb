<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role'); //just the admin
    }

    public function index()
    {
        $clienti = Cliente::all();
        return view('cliente.index', ['listaclienti' => $clienti]);
    }
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }
    public function show(Cliente $cliente)
    {
        //
    }
    public function create()
    {
        //
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('id', $id);
        $cliente->delete();
        return json_encode(['status' => 'ok']);
    }
    public function update(Request $request, Cliente $cliente) {
        $cliente->ragione_sociale = $request->input('ragione_sociale');
        $cliente->nome_referente = $request->input('nome_referente');
        $cliente->cognome_referente = $request->input('cognome_referente');
        $cliente->email_referente = $request->input('email_referente');
        $cliente->save();
        return redirect('/cliente');
    }

    public function store(Request $request) {
        //validate
        $validator = Validator::make($request->all(), [
        //request()->validate([
            'ragione_sociale' => 'required|min:2|max:60',
            'nome_referente' => 'required|min:2|max:60',
            'cognome_referente'=> 'required|min:2|max:60',
            'email_referente' => 'required|email|max:60|unique:clienti,email_referente',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else {

            // 'ragione_sociale', 'nome_referente', 'cognome_referente', 'email_referente'
            $cliente = new Cliente;
            $cliente->ragione_sociale = $request->input('ragione_sociale');
            $cliente->nome_referente = $request->input('nome_referente');
            $cliente->cognome_referente = $request->input('cognome_referente');
            $cliente->email_referente = $request->input('email_referente');



            $cliente->save();
            //$clienti = Cliente::all();
            //return view('clienti', ['listaclienti' => $clienti]);
            return redirect()->route('cliente.index');
        }
    }


}

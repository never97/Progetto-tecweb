<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

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
        return view('clienti', ['listaclienti' => $clienti]);
    }

    public function save(Request $request) {
        //validate
        request()->validate([
            'ragione_sociale' => 'required|max:255',
            'nome_referente' => 'required|max:255',
            'cognome_referente'=> 'required|max:255',
            'email_referente' => 'required|email|max:255',
        ]);

        // 'ragione_sociale', 'nome_referente', 'cognome_referente', 'email_referente'
        $cliente = new Cliente;
        $cliente->ragione_sociale = $request->input('ragione_sociale');
        $cliente->nome_referente = $request->input('nome_referente');
        $cliente->cognome_referente = $request->input('cognome_referente');
        $cliente->email_referente = $request->input('email_referente');
        $cliente->save();
        $clienti = Cliente::all();
        return view('clienti', ['listaclienti' => $clienti]);
    }


}

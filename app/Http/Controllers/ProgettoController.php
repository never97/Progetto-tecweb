<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\SchedaOre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class ProgettoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role'); //just the admin
    }


    public function progGantt(){
        $progetti = Progetto::all();
        return json_encode($progetti);
    }
    public function index() {
        $progetti = Progetto::all();
        $schede_ore=SchedaOre::all();

        /*$data = DB::table("progetti")
            ->select("progetti.nome", "progetti.data_inizio_prevista", "progetti.data_fine_prevista")
            ->get();*/


        return view('progetto.index', compact('progetti','schede_ore'));




        //return view('progetto.create', ['listaclienti' => $clienti]);
    }
    public function create()
    {
        $progetti = Progetto::all();
        $clienti = Cliente::all();
        return view('progetto.create', compact('progetti','clienti'));
    }
    /*public function filter($datainzio, $datafine) {
        //where
        Progetto::where('data_inizio', '>=', $datainzio, 'and', 'data_fine');
        return view('progetto.index', ['listaprogetti' => $progetti],['listaclienti' => $clienti]);
    }*/
    public function show(Progetto $progetto)
    {
        //
    }
    public function update(Request $request, Progetto $progetto) {
        $progetto->nome = $request->input('nome');
        $progetto->descrizione = $request->input('descrizione');
        $progetto->note = $request->input('note');
        $progetto->data_inizio_prevista = $request->input('data_inizio_prevista');
        $progetto->data_fine_prevista = $request->input('data_fine_prevista');
        $progetto->data_fine_effettiva = $request->input('data_fine_effettiva');
        $progetto->costo_orario = $request->input('costo_orario');


        $progetto->save();
        return redirect('/progetto');
    }
    public function edit(Progetto $progetto)
    {
        return view('progetto.edit', compact('progetto'));
    }
    public function destroy($id)
    {
        try {
            $progetto = Progetto::where('id', $id);
            $progetto->delete();
            return json_encode(['status' => 'ok']);
        }catch ( \Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1451){
                return json_encode(['status' => 'failed']);

                //return redirect('progetto.index')->withErrors(['Il dipendente si occupa gi?? di questo progetto']);

            }
        }
    }
    /*public function create()
    {
        $cliente = Cliente::all();

        return view('progetto.create', ['listaclienti' => $cliente]);
    }*/


    public function store(Request $request)
    {
        //validate
        $validator = Validator::make($request->all(), [

            //request()->validate([
            'cliente_id' => 'required',
            'nome' => 'required|min:2|max:50',
            'descrizione' => 'required|max:200',
            'note' => 'max:100',
            'data_inizio_prevista' => 'required|date',
            'data_fine_prevista' => 'required|after_or_equal:data_inizio_prevista',
            'data_fine_effettiva' => 'nullable|after_or_equal:data_inizio_prevista',
            'costo_orario' => 'required|numeric|min:1|max:500',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            //echo $request;
            $progetto = new Progetto;
            $progetto->cliente_id = $request->input('cliente_id');
            $progetto->nome = $request->input('nome');
            $progetto->descrizione = $request->input('descrizione');
            $progetto->note = $request->input('note');
            $progetto->data_inizio_prevista = $request->input('data_inizio_prevista');
            $progetto->data_fine_prevista = $request->input('data_fine_prevista');
            $progetto->data_fine_effettiva = $request->input('data_fine_effettiva');
            $progetto->costo_orario = $request->input('costo_orario');
            $progetto->save();
            return redirect()->route('progetto.index');
        }

    }
}

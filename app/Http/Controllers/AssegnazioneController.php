<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Progetto;
use App\Models\Assegnazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssegnazioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role'); //just the admin
    }

    public function index()
    {
        $progetti=Progetto::all();
        $users= User::all();
        $assegnazioni = Assegnazione::all();
        //return view('assegnazione', ['listassegnazioni' => $assegnazioni],['listautenti' => $users],['listaprogetti' => $progetti]);

        return view('assegnazione',compact(['assegnazioni','progetti','users']));
    }




    public function store(Request $request)
    {
        //validate
        $validator = Validator::make($request->all(), [
            //request()->validate([
            'data_assegnazione' => 'required|date',
            'user_id' => 'required',
            'progetto_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $assegnazione = new Assegnazione();
            $assegnazione->data_assegnazione = $request->input('data_assegnazione');
            $assegnazione->user_id = $request->input('user_id');
            $assegnazione->progetto_id = $request->input('progetto_id');
            try {
                $assegnazione->save();
                return redirect('assegnazione');
            }catch ( \Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return redirect('assegnazione')->withErrors(['Il dipendente si occupa già di questo progetto']);

                }
            }

        }
    }


}

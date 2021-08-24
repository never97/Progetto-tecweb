<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use Illuminate\Http\Request;
use App\Models\SchedaOre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class SchedaOreController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $progetti = $request->user()->progetti; //::where('user_id', $user->id);;
        $schede_ore = SchedaOre::where('user_id','=', $request->user()->id)->get();
        return view('schedaore', ['listaprogetti' => $progetti, 'schedaore' => $schede_ore]);

    }

    public function store(Request $request)
    {
        //validate
        /*$input= $request->all();
        Log::info($input['data_odierna']);
        Log::info($input['ore_unitarie']);
        Log::info($input['note']);
        Log::info($input['user_id']);
        Log::info($input['progetto_id']);
*/

        $validator = Validator::make($request->all(), [


            //request()->validate([
            'data_odierna' => 'required|date',
            //'data_odierna' => 'unique_custom:schede_ore,data_odierna,user_id,' . Auth::id(),
            'ore_unitarie' =>'required',
            //'ore_unitarie' => 'required|numeric|max:8',
            'note' => 'max:200',
            'user_id' => 'required',
            'progetto_id' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            //echo $request;
            $schedaore = new SchedaOre;
            $schedaore->data_odierna = $request->input('data_odierna');
            $schedaore->ore_unitarie = $request->input('ore_unitarie');
            $schedaore->note = $request->input('note');
            $schedaore->user_id = $request->input('user_id');
            $schedaore->progetto_id = $request->input('progetto_id');
            $schedaore->save();
            return redirect('schedaore');
        }

    }

    public function destroy(SchedaOre $schedaore)
    {
        /*$schedaore = SchedaOre::where('id', $id);
        $schedaore->delete();
        return json_encode(['status' => 'ok']);
        */
        if ($schedaore->id > 1) {
            $schedaore->delete();
        }

        // DODO: Lascio come compito quello di risolvere il problema di comunicare all'utente che la categoria con id 1 non può essere cancellata

        return json_encode(['status' => 'ok']);
    }
    public function get($id)
    {
        $schede_ore=SchedaOre::find($id);
        return json_encode(array_merge(['status' => 'ok'], $schede_ore->toArray()));
    }

    public function updateAsync(Request $request) {
        $request->validate([
            'ore_unitarie' => 'required|numeric',
        ]);
        $validator = Validator::make($request->all(), [
            'ore_unitarie' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return json_encode(['result' => 'Errore inserimento']);
        }else {
            $schedaore = SchedaOre::find($request->input('id'));
            $schedaore->data_odierna = $request->input('data_odierna');
            $schedaore->note = $request->input('note');
            $schedaore->ore_unitarie = $request->input('ore_unitarie');
            $schedaore->save();
            return json_encode(array_merge(['status' => 'ok'], $schedaore->toArray()));
        }
    }

}

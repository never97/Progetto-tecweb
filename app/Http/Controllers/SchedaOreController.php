<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use Illuminate\Http\Request;
use App\Models\SchedaOre;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('role')->except('index','filterStat','destroy','updateAsync','get','store'); //just the admin
    }

    public function index(Request $request)
    {
        $progetti = $request->user()->progetti; //::where('user_id', $user->id);;
        $schede = SchedaOre::where('user_id','=', $request->user()->id)->get();
        return view('schedaore', compact('progetti','schede'));


    }

    public function filter(Request $request)
    {
        $id = Auth::id();


        if($request->has(['data_inizio', 'data_fine'])) {
            $data_inizio = $request->input('data_inizio');
            $data_fine = $request->input('data_fine');
        }
        else {
            $startDate = Carbon::now(); //returns current day
            $data_inizio = $startDate->firstOfMonth()->format('Y-m-d');
            $data_fine = $startDate->lastOfMonth()->format('Y-m-d');
        }
        $ore=DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->select("progetti.nome", DB::raw('SUM(schede_ore.ore_unitarie) as totale'))
            ->whereBetween("schede_ore.data_odierna", [date($data_inizio), date($data_fine)])
            ->groupBy("progetti.nome")
            ->get();

        $clientiProg=DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("clienti", function($join){
                $join->on("progetti.cliente_id", "=", "clienti.id");
            })
            ->select("clienti.nome_referente", "clienti.cognome_referente",DB::raw('SUM(schede_ore.ore_unitarie) as totale'))
            ->whereBetween("schede_ore.data_odierna", [date($data_inizio), date($data_fine)])
            ->groupBy("clienti.nome_referente","clienti.cognome_referente")
            ->get();

         $users = DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("users", function($join){
                $join->on("schede_ore.user_id", "=", "users.id");
            })
            ->select(DB::raw("COUNT(*) as count"))
            ->whereYear('data_odierna', date('Y'))
            ->groupBy(DB::raw("Month(data_odierna)"))
            ->where("users.id", "=", [$id])
            ->pluck('count');

        $mesi1 = DB::table("progetti")
            ->select(DB::raw("progetti.nome"))
            ->get();




        return view('operazioni', compact('ore','clientiProg', 'data_inizio', 'data_fine','mesi1'));


    }
    function filterStat(Request $request){
        $id = Auth::id();

        $statistiche=DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("users", function($join){
                $join->on("schede_ore.user_id", "=", "users.id");
            })
            ->select("users.id","users.nome as utente","progetti.nome as progetto", DB::raw("SUM(schede_ore.ore_unitarie)as totale"))
            ->where("users.id", "=", [$id])
            ->groupBy("utente","progetto","users.id")
            ->get();

        if($request->has(['data_check'])) {
            $data_check = $request->input('data_check');

        }
        else {
            $startDate = Carbon::now(); //returns current day
            $data_check = $startDate->today()->format('Y-m-d');
        }



        $straordinari=DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("users", function($join){
                $join->on("schede_ore.user_id", "=", "users.id");
            })
            ->select("schede_ore.data_odierna", DB::raw("(schede_ore.ore_unitarie - 8) as straordinari"))
            ->where("users.id", "=", [$id])
            ->where("schede_ore.ore_unitarie", ">", "8")
            ->where("schede_ore.data_odierna", "=", [date($data_check)])
            ->get();



        if($request->has(['mese'])) {
            $mese = $request->input('mese');
            //dd($mese);


                if($mese=="Gennaio"){
                    $month="01";
                }else if($mese=="Febbraio"){
                    $month="02";
                }else if($mese=="Marzo"){
                    $month="03";
                }else if($mese=="Aprile"){
                    $month="04";
                }else if($mese=="Maggio"){
                    $month="05";
                }else if($mese=="Giugno"){
                    $month="06";
                }else if($mese=="Luglio"){
                    $month="07";
                }else if($mese=="Agosto"){
                    $month="08";
                }else if($mese=="Settembre"){
                    $month="09";
                }else if($mese=="Ottobre"){
                    $month="10";
                }else if($mese=="Novembre"){
                    $month="11";
                }else if($mese=="Dicembre"){
                    $month="12";
                }
        }
        else {
            $startMese = Carbon::now(); //returns current day
            $month = $startMese->today()->format('m');
            //dd($month);
            if($month=="01"){
                $mese="Gennaio";
            }else if($month=="02"){
                $mese="Febbraio";
            }else if($month=="03"){
                $mese="Marzo";
            }else if($month=="04"){
                $mese="Aprile";
            }else if($month=="05"){
                $mese="Maggio";
            }else if($month=="06"){
                $mese="Giugno";
            }else if($month=="07"){
                $mese="Luglio";
            }else if($month=="08"){
                $mese="Agosto";
            }else if($month=="09"){
                $mese="Settembre";
            }else if($month=="10"){
                $mese="Ottobre";
            }else if($month=="11"){
                $mese="Novembre";
            }else if($month=="12"){
                $mese="Dicembre";
            }
        }


        $calendario=DB::table("schede_ore")
                ->join("progetti", function($join){
                    $join->on("schede_ore.progetto_id", "=", "progetti.id");
                })
                ->join("users", function($join){
                    $join->on("schede_ore.user_id", "=", "users.id");
                })
                ->select("schede_ore.data_odierna", "schede_ore.ore_unitarie", "schede_ore.note", "progetti.nome", DB::raw("(extract(month from schede_ore.data_odierna))as mese"))
                ->where("users.id", "=", [$id])
                ->having(DB::raw('mese'), '=', $month)
                ->get();


        $users = DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("users", function($join){
                $join->on("schede_ore.user_id", "=", "users.id");
            })
            ->select(DB::raw("COUNT(*) as count"))
            ->whereYear('data_odierna', date('Y'))
            ->groupBy(DB::raw("Month(data_odierna)"))
            ->where("users.id", "=", [$id])
            ->pluck('count');

        $mesi1 = DB::table("schede_ore")
            ->join("progetti", function($join){
                $join->on("schede_ore.progetto_id", "=", "progetti.id");
            })
            ->join("users", function($join){
                $join->on("schede_ore.user_id", "=", "users.id");
            })
            ->select(DB::raw("Month(data_odierna) as mese1"))
            ->whereYear('data_odierna',date('Y'))
            ->where("users.id", "=", [$id])
            ->groupBy(DB::raw("Month(data_odierna)"))
            ->pluck('mese1');



        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($mesi1 as $index => $mese1){
            $datas[$mese1-1]=$users[$index];
        }



        return view('statistiche', compact('statistiche','straordinari','data_check','calendario','mese','month','datas'));


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

    public function destroy($id)
    {
        $schedaore = SchedaOre::where('id', $id);
        $schedaore->delete();
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

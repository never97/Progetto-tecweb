<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchedaOre;

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
        $user = $request->user();
        $schedaOre = SchedaOre::where('user_id', $user->id);
        return view('schedaore', ['schedaore' => $schedaOre]);
    }
}

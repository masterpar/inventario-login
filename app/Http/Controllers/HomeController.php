<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tool;
use App\Petition;
use Carbon\Carbon;
class HomeController extends Controller
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
        $users_count = User::count();
        $tools_count = Tool::count();
        $petition_count = Petition::where('estado', '=', 'Pendiente')->count();
        $petition_revisar_count = Petition::where('estado', '=', 'Revisión')->count();
        $petitions = Petition::where('estado', '=', 'Pendiente')->paginate(5);
        $tools = Tool::all();
        $vencidas = Petition::where('estado', '=', 'Aprobada')->whereDate('f_devolucion', '<=', Carbon::now()->format('Y-m-d'))->count();
         if ($request->user()->tipo !='Admin') {
          return redirect ('/mispeticiones/');
        }

        return view('home',compact('users_count','vencidas','tools','petition_count','petitions','petition_revisar_count'));
        
    }
}

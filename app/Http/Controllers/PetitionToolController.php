<?php

namespace App\Http\Controllers;

use App\PetitionTool;
use App\Petition;
use App\Tool;
use Illuminate\Http\Request;

class PetitionToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function prueba($fecha , Request $request)
    {
        $cont = 0;
       
        //$elementos = PetitionTool::where();
        $cart = \Session::get('cart');
        $petitions = Petition::where('estado', '=', 'Aprobada')->whereDate('f_apartada', '<=',$fecha)->get();
        foreach($cart as $tool_c){

            foreach ($petitions as $petition) {
                
                $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
                 error_log('Some message here.'.$petition->id);
                foreach ($petitiontools as $petitiontool) {

                    $tool = Tool::find($petitiontool->tool_id);
                    if ($tool_c->id == $tool->id) {
                        
                         $resta = $tool->cantidad_disponible - $petitiontool->cantidad_aprobada;
                         error_log('Some message here.');
                             if ($resta == 0) {
                                
                                $cont++;
                             }
                    }
                }
        }
        }
        return response()->json($cont);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PetitionTool  $petitionTool
     * @return \Illuminate\Http\Response
     */
    public function show(PetitionTool $petitionTool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PetitionTool  $petitionTool
     * @return \Illuminate\Http\Response
     */
    public function edit(PetitionTool $petitionTool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PetitionTool  $petitionTool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetitionTool $petitionTool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PetitionTool  $petitionTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetitionTool $petitionTool)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Petition;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PetitionTool;
use App\Tool;
use Session;
use Mail;
use App\Mail\MailSolicitud;
use App\Mail\MailRespuesta;
use App\Mail\MailEntrega;
use App\Mail\MailElementoDev; 
use App\Mail\MailRevision;
use Barryvdh\DomPDF\Facade as PDF;
class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['create','store','mispeticiones','show','update_devuelta','devolver','comentar','pedirele']);
        
    }

    public function index()
    {
        $petitions = Petition::where('estado', '=', 'Pendiente')->paginate(5);
        return view('petitions.index_pendientes',compact('petitions'));
    }


        public function create()
    {
        $cart = \Session::get('cart');
        return view('petitions.create',compact('cart'));
    }

    
    public function store(Request $request)
    {
        $cart = \Session::get('cart');
        $f_apartada = $request['f_apartada'] ? Carbon::parse($request['f_apartada'])->format('Y-m-d')  : null ;
        $petition = $request->user()->petitions()->create([
            'nombre' => $request['nombre'],
            'justificacion' => $request['justificacion'],
            'f_devolucion' => Carbon::parse($request['f_devolucion'])->format('Y-m-d'), 
            'f_apartada' => $f_apartada, 
        ]);

        foreach($cart as $tool){
            $this->GuardarPetitionTool($tool, $petition->id);
        }

        \Session::forget('cart');
        //correo donde van a llegar
        // Mail::to('juan.cuero@unillanos.edu.co')->send(new MailSolicitud(
        //   $request->user()->name,
        //   $request->user()->email,
        //   $cart,
        //   $petition->nombre,
        //   $petition->created_at,
        //   $petition->f_devolucion,
        //   $petition->justificacion
        //   ));
        
        return redirect ('/mispeticiones/');

    }


   
    public function show(Petition $petition)
    {
        $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
        return view('petitions.show',compact('petition','petitiontools')) ;
    }

  

    private function GuardarPetitionTool($tool, $petition_id)
    {
        PetitionTool::create([
            'cantidad' => $tool->cantidad,
            'tool_id' => $tool->id,
            'petition_id' => $petition_id
        ]);
    }

    public function aprobar(Request $request, Petition $petition)
    {
        $petition->estado = "Aprobada";
        $petition->f_aprobada = Carbon::now()->format('Y-m-d');
        $petition->save();
        $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
        $respuesta = "Aprobada";
        
        // $petition->user->email) cambiar mi correo para que le llegue un correo al usuario diciendole que la petición fue aprobada
        
        // Mail::to('juan.cuero@unillanos.edu.co')->send(new MailRespuesta(
        //    $petition->nombre,
        //   $respuesta
        //   ));



        return redirect ('/aprobadas/');
    }

    public function aprobartodo(Request $request, Petition $petition)
    {
  
     foreach ($petition->petition_tools as $petition_tools) {
         $petition_tools->cantidad_aprobada = $petition_tools->cantidad;
         $petition_tools->save();
         if($petition->f_apartada == null){
         $tool = Tool::find($petition_tools->tool_id);
         $tool->cantidad_disponible = $tool->cantidad_disponible - $petition_tools->cantidad_aprobada;
         $tool->save();
         }
     }

    $petition->estado = "Aprobada";
    $petition->f_aprobada = Carbon::now()->format('Y-m-d');
    $petition->save();
    // $petition->user->email) cambiar mi correo para que le llegue un correo al usuario diciendole que la petición fue aprobada
    $respuesta = "Aprobada";
        // Mail::to('juan.cuero@unillanos.edu.co')->send(new MailRespuesta(
        //    $petition->nombre,
        //   $respuesta
        //   ));

      return redirect ('/aprobadas/');
    }

    public function aprobadas()
    {
        $petitions = Petition::where('estado', '=', 'Aprobada')->paginate(5);
        return view('petitions.index_aprobadas',compact('petitions'));
    }

    public function vencidas()
    {
        $petitions = Petition::where('estado', '=', 'Aprobada')->whereDate('f_devolucion', '<=', Carbon::now()->format('Y-m-d'))->paginate(5);
        return view('petitions.index_vencidas',compact('petitions'));
    }

    public function revisar()
    {
        $petitions = Petition::where('estado', '=', 'Revisión')->paginate(5);
        return view('petitions.revisar',compact('petitions'));
    }

    public function mispeticiones(Request $request)
    {   
        $petitions = $request->user()->petitions()->orderBy('id','desc')->paginate(5);
        return view('petitions.mispeticiones',compact('petitions'));
    }

    public function update_cant($id_petition, $tool_id, $cantidad)
    {
        $petition = Petition::find($id_petition);
        $petitiontool= $petition->petition_tools()->where('tool_id',$tool_id)->get()->first();        
        $tool = Tool::find($tool_id);        
        $ap = (int)$petitiontool->cantidad_aprobada;       
       if ($cantidad <= $tool->cantidad_disponible) {

       if($petition->f_apartada == null){
       if ($ap < $cantidad) {
         $aux = $ap + $cantidad;
        $tool->cantidad_disponible = $tool->cantidad_disponible - $aux;
                             }

       if ($ap > $cantidad) {
         $aux = $ap - $cantidad;
        $tool->cantidad_disponible = $tool->cantidad_disponible + $aux;
                            }
       
                                         }

        $petitiontool->cantidad_aprobada=$cantidad;

        $tool->save();
        //quitar el boton
        $petitiontool->save();
        
        return redirect ('/petition/'.$id_petition);
       } else{
        \Session::flash('message-error','Error en la cantidad');
         return redirect ('/petition/'.$id_petition);
       }
    }

    public function update_devuelta(Request $request,$id_petition, $tool_id, $cantidad_dev)
    {
        $petition = Petition::find($id_petition);
        $petitiontool= $petition->petition_tools()->where('tool_id',$tool_id)->get()->first();
        $petitiontool->cantidad_devuelta = $cantidad_dev;
        $petitiontool->cantidad_aprobada = $petitiontool->cantidad_aprobada - $cantidad_dev;
        $petitiontool->save();

        $tool = Tool::find($tool_id);
        $tool->cantidad_disponible = $tool->cantidad_disponible + $cantidad_dev;      
        $tool->save();
       //correo donde van a llegar
    //    Mail::to('juan.cuero@unillanos.edu.co')->send(new MailElementoDev(
    //       $request->user()->name,
    //       $tool->nombre,
    //       $petition->nombre,
    //       $cantidad_dev
    //       ));

    #TODO: ÚLTIMO RECURSO
        if ($tool->cantidad_disponible == 0) {
            $petition->estado = "Revisión";
            $petition->f_devolucion_real = Carbon::now()->format('Y-m-d');
            $petition->save();
            Session::flash('message','Petición terminada correctamente. El administrador revisará los elementos.');
            return redirect ('/mispeticiones/');
        }
        return redirect ('/petition/'.$id_petition);
    }

    public function devolver(Request $request, Petition $petition)
    {
    
        $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
      
        foreach ($petitiontools as $petitiontool) {
            $petitiontool->cantidad_devuelta = $petitiontool->cantidad_aprobada;
            $petitiontool->save();
            $tool = Tool::find($petitiontool->tool_id);
            $tool->cantidad_disponible = $tool->cantidad_disponible + $petitiontool->cantidad_aprobada;
            $tool->save();

        }
      
        $petition->estado = "Revisión";
        $petition->f_devolucion_real = Carbon::now()->format('Y-m-d');
        $petition->save();
    //    Mail::to('juan.cuero@unillanos.edu.co')->send(new MailRevision(
    //       $request->user()->name,
    //       $petition->nombre
    //       ));

        Session::flash('message','Petición terminada correctamente. El administrador revisará los elementos.');
        return redirect ('/mispeticiones/');
    
       
    }

    public function finalizar(Request $request, Petition $petition)
    {
        $petition->estado = "Finalizada";
        $petition->save();
        $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
        return redirect ('/finalizadas/');
    }

    public function finalizadas()
    {
        $petitions = Petition::where('estado', '=', 'Finalizada')->paginate(5);
        return view('petitions.finalizadas',compact('petitions'));
    }

    public function comentar(Request $request, Petition $petition)
    {
        $petition->observacion = $request['observacion'];
        $petition->save();
        Session::flash('message','Se ha agregado los comentarios exitosamente.');
        return redirect ('/petition/'.$petition->id);
    }

    public function comentar2(Request $request, Petition $petition)
    {
        $petition->observacion_admin = $request['observacion_admin'];
        $petition->save();
        Session::flash('message','Se ha agregado los comentarios exitosamente.');
        return redirect ('/petition/'.$petition->id);
    }

    public function rechazar(Request $request, Petition $petition)
    {
        $petition->estado = "Rechazada";
        $petition->save();
        $petitiontools = PetitionTool::where('petition_id', $petition->id)->get();
      
        foreach ($petitiontools as $petitiontool) {
            $petitiontool->cantidad_aprobada = 0;
            $petitiontool->save();
        }
        // $petition->user->email) cambiar mi correo para que le llegue un correo al usuario diciendole que la petición fue Rechazada
    $respuesta = "Rechazada";
        // Mail::to('juan.cuero@unillanos.edu.co')->send(new MailRespuesta(
        //    $petition->nombre,
        //   $respuesta
        //   ));
        
        return redirect ('/rechazadas/');
    }

    public function rechazadas()
    {
        $petitions = Petition::where('estado', '=', 'Rechazada')->paginate(5);
        return view('petitions.rechazadas',compact('petitions'));
    }

    public function pedirele(Request $request, Petition $petition)
    {
        $petition->recogida = '1';
        foreach ($petition->petition_tools as $petition_tools) {
   
         $tool = Tool::find($petition_tools->tool_id);
         $tool->cantidad_disponible = $tool->cantidad_disponible - $petition_tools->cantidad_aprobada;
         $tool->save();
         
     }
        $petition->save();
        return redirect ('/petition/'.$petition->id);
    }

    public function destroy($id)
    {
        $petition = Petition::findOrFail($id);
        $petition->delete();
        return redirect('/vencidas'); 
    }

    public function pdf($id)
    {
        //$petitiontools = PetitionTool::where('petition_id', $petition->id)->get();/
        //dd($id);
        $petition = Petition::find($id);
        
        $pdf = PDF::loadView('pdf.reporte', compact('petition'));

        return $pdf->download('reporte.pdf');
    }

}

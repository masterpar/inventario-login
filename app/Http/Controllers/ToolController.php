<?php

namespace App\Http\Controllers;

use App\Tool;
use Illuminate\Http\Request;
use App\Http\Requests\ToolCreateRequest;
use Image;
use App\Category;
use App\Subcategory;
use App\User;
use App\ToolUser;
use Carbon\Carbon;
use Mail;
use App\Mail\MailSolicitud;
use App\Mail\MailRespuesta;
use App\Mail\MailEntrega;
use DB;
class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'form_solicitar','guardar_solicitud','solicitados','entregar','show']);
        
    }


    public function index(Request $request)
    {
        // $categories = Category::pluck('nombre','id');
        $categories = Category::pluck('nombre');
        if ($request->user()->tipo =='Admin') {
          $tools = Tool::nombre($request->get('nombre'))->latest()->paginate(5);
          return view('tools.index',compact('tools'));
        }
        $tools = Tool::nombre($request->get('nombre'))->categoria($request->get('category_id'))->where('cantidad_disponible','>', 0)->latest()->paginate(5);
        return view('tools.index2',compact('tools','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('nombre','id');
        return view('tools.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToolCreateRequest $request)
    {

        $category_id = $request['category_id'];       
        $imagen = $request->file('imagen');
        $filename  = time() . 'imagen' . '.' . $imagen->getClientOriginalExtension();
        $path = public_path('imagenes/' . $filename);
        $url = '/imagenes/'.$filename;
         


        $subcategory_id = $request['subcategory_id'];
        if ($subcategory_id == "Seleccione subcategoría") {
          $subcategory_id = null;
        }
        $tool = Category::find($category_id)->tools()->create([
            'subcategory_id' => $subcategory_id,
            'nombre' => $request['nombre'],
            'imagen' => $url,
            'descripcion' => $request['descripcion'],
            'cantidad_disponible' => $request['cantidad_disponible'],
        ]);
   
         Image::make($imagen->getRealPath())->resize(800, 800)->save($path);

        return redirect('/tool')->with('message','Elemento Creado Correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        return view('tools.show',compact('tool')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        $categories = Category::pluck('nombre','id');
        return view('tools.edit',['tool'=>$tool],compact('categories')) ;
    }

    
    public function update(Request $request, Tool $tool)
    {   
        
        $imagen = $request->file('imagen');
        $filename  = time() . 'imagen' . '.' . $imagen->getClientOriginalExtension();
        $path = public_path('imagenes/' . $filename);
        $url = '/imagenes/'.$filename;
       Image::make($imagen->getRealPath())->resize(800, 800)->save($path);
        $tool->fill([
            'category_id' => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'nombre' => $request['nombre'],
            'imagen' => $url,
            'descripcion' => $request['descripcion'],
            'cantidad_disponible' => $request['cantidad_disponible'],


        ]);
        
        $tool->save();
        

        return redirect('/tool/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();

        return redirect ('/tool');
    }


    public function form_solicitar(Tool $tool)
    {
        $categories = Category::pluck('nombre','id');
        return view('tools_users.create',['tool'=>$tool],compact('categories')) ;
    }


    public function guardar_solicitud(Request $request)
    {
        

        $tool = Tool::find($request['tool_id']);
        $id_user=$request->user()->id;
        $user = User::find($id_user);
        $f_devolucion=$request['f_devolucion'];
        $justificacion=$request['justificacion'];
        $tool->users()->attach($id_user, ['f_devolucion' => $f_devolucion,
                                          'justificacion' => $justificacion
                                            ]);
        $tool->save();
        $x=$tool->users()->wherePivot('f_devolucion','=', $f_devolucion)->get()->last();
        $data['usuario'] = $user->name;
        $data['email'] = $user->email;
        $data['elemento'] = $tool->nombre;
        $data['f_solicitud'] = $x->pivot->created_at;
        $data['f_devolucion'] = $f_devolucion;


        //send email
        /*
        Mail::send('emails.nueva_solicitud',$data, function($message){
            $message->to('juan.cuero@unillanos.edu.co','juan cuero')->subject('Nueva solicitud de elemento');
        });*/


         Mail::to('juan.cuero@unillanos.edu.co')->send(new MailSolicitud(
          $user->name,
          $user->email,
          $tool->nombre,
          $x->pivot->created_at,
          $f_devolucion,
          $justificacion
          ));

        return redirect ('/tool/');

    }

    public function solicitados(Request $request)
    {
          
        $users = User::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();

        $tools = Tool::all();
        /*
        foreach ($tools as $tool) {
          $x = $tool->users()->whereDate('f_devolucion', '=', Carbon::now()->format('Y-m-d'))->get();
          echo $x;
        }*/
        
        


        $tools = $request->user()->tools()
                                ->wherePivot('aprobada','=',"Aprobada")
                                ->paginate(5);

        return view('tools.solicitados',compact('tools'));
    }


    public function entregar(Request $request)
    {
        
        $tool = Tool::find($request['tool_id']);
        $x = $tool->users()
                ->wherePivot('id', $request['id'])
                ->first();
        $x->pivot->aprobada = "Entregado";
        $x->pivot->save();

        Mail::to('juan.cuero@unillanos.edu.co')->send(new MailEntrega(
          $request->user()->name,
          $tool->nombre,
          $x->pivot->updated_at,
          $x->pivot->observacion
          ));
        
        return redirect ('/solicitados/');

    }

    public function solicitudes(Request $request)
    {
        $tools = Tool::paginate(10);
        return view('tools_users.solicitudes',compact('tools'));
    }

    public function aprobar(Request $request)
    {
        $tool = Tool::find($request['tool_id']);
        $tool->disponible = 'No';
        $x = $tool->users()
                ->wherePivot('id', $request['id'])
                ->first();
        $x->pivot->aprobada = "Aprobada";
        $x->pivot->save();
        $tool->save();
        
        $data['elemento'] = $tool->nombre;
        $respuesta = "Aprobada";

        /*
        Mail::send('emails.solicitud_respuesta',$data, function($message){
            $message->to('juan.cuero@unillanos.edu.co','juan cuero')->subject('Solicitud de elemento aprobada');
        }); */


      Mail::to('juan.cuero@unillanos.edu.co')->send(new MailRespuesta(
          $tool->nombre,
          $respuesta
          ));


        $users = $tool->users()
                    ->wherePivot('tool_id','=',$tool->id)
                    ->wherePivot('aprobada','=',"En espera")
                    ->get()->pluck('email');
    
             /*   
            Mail::send('emails.solicitud_respuesta',$data, function($message){
                $message->to('juan.cuero@unillanos.edu.co','juan cuero')->subject('Solicitud de elemento rechazada');
            }); */
        $respuesta2 = "Rechazada";
        Mail::to('juan.hortua@unillanos.edu.co')->send(new MailRespuesta(
          $tool->nombre,
          $respuesta2
          ));



        return redirect ('/solicitudes/');
    }


public function rechazar(Request $request)
    {
        $tool = Tool::find($request['tool_id']);
        $x = $tool->users()
                ->wherePivot('id', $request['id'])
                ->first();
        $x->pivot->aprobada = "Rechazada";
        $x->pivot->save();
        $tool->save();
        
        $data['elemento'] = $tool->nombre;
        $data['respuesta'] = "Rechazada";

        
        Mail::send('emails.solicitud_respuesta',$data, function($message){
            $message->to('juan.cuero@unillanos.edu.co','juan cuero')->subject('Solicitud de elemento rechazada');
        }); 

    
        return redirect ('/solicitudes/');
    }

    public function aprobadas(Request $request)
    {
        $tools = Tool::paginate(10);
        return view('tools_users.aprobadas',compact('tools'));
    }

    public function observacion(Tool $tool,$id)
    {
       
        $x = $tool->users()
                ->wherePivot('id', $id)
                ->first();
        
        return view('tools_users.observacion',compact('x','tool')) ;
    }

    public function guardar_observacion(Request $request)
    {
        $tool = Tool::find($request['tool_id']);
        $x = $tool->users()
                ->wherePivot('id', $request['id'])
                ->first();
        $x->pivot->observacion = $request['observacion'];
        $x->pivot->save();

        return redirect ('/solicitados/');
    }


    public function finalizar(Request $request)
    {
        $tool = Tool::find($request['tool_id']);
        $tool->disponible = 'Sí';
        $x = $tool->users()
                ->wherePivot('id', $request['id'])
                ->first();
        $x->pivot->aprobada = "Finalizada";
        $x->pivot->save();
        $tool->save();
        
        return redirect ('/solicitudes/aprobadas');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $tool = Tool::find($id);
            $tool->delete();
        }
    
         return response()->json(["mensaje" => "listo"]);
    }
    

    



}

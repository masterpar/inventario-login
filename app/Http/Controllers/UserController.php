<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use Session;
use Redirect;

class UserController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['logout']);
    }

    
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index',compact('users'));
    }

 
    public function create()
    {
        return view('users.create');
    }

  
    public function store(UserCreateRequest $request)
    {

        $user= User::create([
            'name' => $request['name'],
            'cc' => $request['cc'],
            'telefono' => $request['telefono'],
            'email' => $request['email'],
            'tipo' => $request['tipo'],
            'password' => bcrypt($request['password']),
        ]);
        \Session::flash('message','Usuario creado Correctamente');
        return redirect('/user');
    }

  
    public function show($id)
    {
       // return redirect('/');
    }


    public function edit(User $user)
    {
        return view('users.edit',['user'=>$user]);
    }

  
    public function update(UserUpdateRequest $request, User $user)
    {         
            $user->name = $request['name'];
            $user->cc = $request['cc'];
            $user->telefono = $request['telefono'];
            $user->email = $request['email'];
            $user->tipo = $request['tipo'];
            $user->password = bcrypt($request['password']);

         $user->save();
         return redirect('/user');
    }

    public function destroy($id)
    {
        //
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $user = User::find($id);
            $user->delete();
        }
    
         return response()->json(["mensaje" => "listo"]);
    }
    


}

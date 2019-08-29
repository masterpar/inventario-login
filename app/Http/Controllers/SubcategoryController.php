<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use Session;
use App\Category;
use App\Tool;


class SubcategoryController extends Controller
{
   
    public function index(Category $category)
    {
        $subcategories= Category::find($category->id)->subcategories()->paginate(10);        
        return view('subcategories.index',compact('category','subcategories'));
    }


    public function create(Category $category)
    {
        return view('subcategories.create',compact('category'));
    }


    public function store(Request $request,Category $category)
    {
       
            if($request->ajax()){
               $category->subcategories()->create([
                 'nombre' => $request['nombre']
                ]);
            return response()->json([
                "mensaje" => "creado"
             ]);
            }
    }

   
    public function show(Subcategory $subcategory)
    {
        //
    }


    public function edit(Category $category, Subcategory $subcategory)
    {
        $subcategories= $category->first()->subcategories()->paginate(10);        
        return view('subcategories.edit',compact('category','subcategory','subcategories'));
    }


    public function update (Request $request, Category $category, Subcategory $subcategory)
    {
        
        $subcategory->fill($request->all());
        $subcategory->save();
        return response()->json(["mensaje" => "listo"]);
    }

   
    public function destroy(Category $category, Subcategory $subcategory)
    {

        //         dd($subcategory->id);
        // if (Tool::where($subcategory->id, $subcategory)->exists()) {
        //     Session::flash('message','error al eliminar');
        //     return redirect('/category/'.$category->id);
        // } else
        //     {
        //     $subcategory->delete();
        //     Session::flash('message','Subcategoria Eliminada Correctamente');
        //     return redirect('/category/'.$category->id);
        //     }
    }

    public function deleteAll(Request $request)
    {
      dd($request);
        $idsSub = $request['ids'];
        foreach ($idsSub as $idSub) {
           // dd($idSub);
            if (Tool::where($id, $idSub)->exists()) {
                Session::flash('message','=','Error al eliminar'); 
            }
            $subcategory = Subcategory::find($id);
           $subcategory->delete();
        }
         // return response()->json(["mensaje" => "listo"]);
    }     

}

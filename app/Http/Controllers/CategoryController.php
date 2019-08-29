<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;
use Session;
use App\Subcategory;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        
    }

    public function index()
    {
        $categories = Category::all();
    return view('categories.index');
        //return view('categories.index',compact('categories'));
        
    }

    public function categoryGetAll()
    {
        $categories = Category::all();
        return \Response::json($categories);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        /*
        $category = Category::create([
            'nombre' => $request['nombre'],
        ]);
        */
        if($request->ajax()){
        
         $category = Category::create([
            'nombre' => $request['nombre'],
        ]);
            
          

            return response()->json([
                "mensaje" => "creado"
            ]);
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
        return view('categories.show',compact('category')) ;
    }

    public function subcategoryGetAll(Category $category)
    {
        $subcategories= $category->subcategories()->get();
        return \Response::json($subcategories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::paginate(5);
        return view('categories.edit',['category'=>$category],compact('categories')) ;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return response()->json(["mensaje" => "listo"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('message','Categoria Eliminada Correctamente');
        return redirect('/category');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $category = Category::find($id);
            $category->delete();
        }
    
         return response()->json(["mensaje" => "listo"]);
    }
    

    public function getSubcategories(Request $request,$id)
    {
        if($request->ajax()){
            
            $subcategories = Subcategory::getsubcategories($id);
            //$subcategories= Category::find($category->id)->subcategories()->get();
            return response()->json($subcategories);
        }
        
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Tool;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if(!\Session::has('cart')) \Session::put('cart',array());
        
    }

    // Shoe cart

    public function show()
    {
    	$cart = \Session::get('cart');
    	return view('cart.show',compact('cart'));
    }

    public function add(Tool $tool)
    {
    	$cart = \Session::get('cart');
    	$tool->cantidad = 1;
    	$cart[$tool->id] = $tool;
    	\Session::put('cart',$cart);
        \Session::flash('message','Elemento agregado Correctamente');
    	return redirect()->route('cart-show');
    }


    public function delete(Tool $tool)
    {
    	$cart = \Session::get('cart');
    	unset($cart[$tool->id]);
    	\Session::put('cart',$cart);
        \Session::flash('message','Elemento removido Correctamente');
    	return redirect()->route('cart-show');
    }

    public function trash(Tool $tool)
    {

        \Session::flash('message','Elementos removidos Correctamente');
    	\Session::forget('cart');

    	return redirect()->route('cart-show');
    }
    // Update item
    public function update(Tool $tool, $cantidad)
    {

        $cart = \Session::get('cart');
        if ($cantidad > $tool->cantidad_disponible) {
            \Session::flash('message-error','Error en la cantidad');
             return redirect()->route('cart-show');
        }
        $cart[$tool->id]->cantidad = $cantidad;
        \Session::put('cart', $cart);
        \Session::flash('message','Cantidad actualizada Correctamente');

        return redirect()->route('cart-show');
    }

}

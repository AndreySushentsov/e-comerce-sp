<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
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
        $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
          return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
          return redirect()->route('cart.index');
        }

        Cart::add($request->id, $request->name, 1, $request->price)
            ->associate('App\Product');

        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);

        session()->flash('success_message', 'Количество товаров обновлено');
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back();
    }

    /**
     * Save for Later
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveForLater($id)
    {
      $item = Cart::get($id);

      Cart::remove($id);

      $duplicates = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
        return $rowId->id === $id;
      });

      if($duplicates->isNotEmpty()){
        return redirect()->route('cart.index');
      }

      Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
          ->associate('App\Product');

      return redirect()->route('cart.index');
    }
}

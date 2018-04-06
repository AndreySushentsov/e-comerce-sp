<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

class SaveForLaterController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success message', 'Товар был перемещен удален');
    }

    /**
     * Switch item to Cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
      $item = Cart::instance('saveForLater')->get($id);

      Cart::instance('saveForLater')->remove($id);

      $duplicates = Cart::instance('default')->search(function($cartItem, $rowId) use ($id){
        return $rowId === $id;
      });

      if($duplicates->isNotEmpty()){
        return redirect()->route('cart.index');
      }

      Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
          ->associate('App\Product');

      return redirect()->route('cart.index');
    }
}

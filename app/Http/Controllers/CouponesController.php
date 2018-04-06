<?php

namespace App\Http\Controllers;

use App\Coupone;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CouponesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupone = Coupone::where('code', $request->coupon_code)->first();

        if(!$coupone){
          return redirect()->route('checkout.index')->withErrors('Не верный код, попробуйте еще раз.');
        }

        session()->put('coupone', [
          'name' => $coupone->code,
          'discount' => $coupone->discount(Cart::subtotal()),
        ]);

        return redirect()->route('checkout.index')->with('success_message', 'Поздравляем, купон принят!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

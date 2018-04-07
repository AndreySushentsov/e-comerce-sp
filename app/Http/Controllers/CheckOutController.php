<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $discount = session()->get('coupone')['discount'];
      $newTotal = Cart::total() - $discount;
        return view('checkout')->with([
          'discount' => $discount,
          'newTotal' => $newTotal,
        ]);
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
        $contents = Cart::content()->map(function($item)
        {
          return $item->model->slug.', '.$item->qty;
        })->values()->toJson();

        try {
          // $charge = Stripe::charges()->create([
          //   'amount' => Cart::total() / 100,
          //   'currency' => 'RUB',
          //   'source' => $request->stripeToken,
          //   'description' => 'Order',
          //   'receipt_email' => $request->email,
          //   'metadata' => [
          //     'contents' => $contents,
          //     'quantity' => Cart::instance('default')->count(),
          //     'discount' => collect(session()->get('coupon'))->toJson(),
          //   ],
          // ]);


          $order = $this->addToOrdersTables($request, null);

          // Mail::send(new OrderPlaced($order));

          Cart::instance('default')->destroy();
          session()->forget('coupone');

          return back()->with('success_message', 'Заказ принят, проверте пожалуйста почту, мы свяжемся с вами в ближайшее время, что бы обсудить условия доставки и оплаты.');

        } catch (CardErrorException $e) {
          $this->addToOrdersTables($request, $e->getMessage());
          return back()->withErrors('Error ' . $e->getMessage());
        }
    }


    protected function addToOrdersTables($request, $error)
    {
      // dd($request->all());
      //Добавить в таблицу Order
      $order = Order::create([
        'user_id' => auth()->user() ? auth()->user()->id : null,
        'billing_region' => $request->region,
        'billing_post-code' => $request->post,
        'billing_city' => $request->city,
        'billing_street'=> $request->street,
        'billing_house'=> $request->house_number,
        'billing_flat' => $request->flat_number,
        'billing_name' => $request->name,
        'billing_surname' => $request->surname,
        'billing_email'=> $request->email,
        'billing_phone' => $request->phone,
        'billing_comments' => $request->comments,


        // 'billing_discount' => $this->getNumbers()->get('discount'),
        // 'billing_discount_code' => $this->getNumbers()->get('code'),
        // 'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
        // 'billing_total' => $this->getNumbers()->get('newTotal'),
        'billing_discount' => 0,
        'billing_discount_code' => '',
        'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
        'billing_total' => $this->getNumbers()->get('newTotal'),
      ]);

      //Добавить в таблицу order_product
      foreach(Cart::content() as $item){
        OrderProduct::create([
          'order_id' => $order->id,
          'product_id' => $item->model->id,
          'quantity' => $item->qty,
        ]);
      }

      return $order;
    }

    private function getNumbers()
    {
        // $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'];
        $code = session()->get('coupon')['name'];
        $newSubtotal = (Cart::subtotal() - $discount);
        // $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal;

        return collect([
            // 'tax' => $tax,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            // 'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
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
        //
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

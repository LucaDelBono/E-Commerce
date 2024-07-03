<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Routing\Controller;

class StripeController extends Controller
{
    public function stripe()
    {
        if($this->productNotAviable()){
            return back()->with('error','Quantità articoli non disponibile');
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SK'));
        $cartItems= Cart::with('item')->where('user_id', auth()->user()->id)->get();
        $lineItems= [];

        foreach($cartItems as $cartItem){
            $lineItems[] = [ 
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name'=> $cartItem->item->name
                        ],
                        'unit_amount' => $cartItem->item->price * 100,
                    ],                   
                    'quantity' => $cartItem->quantity,
            ];
        }
        $response = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        foreach($cartItems as $cartItem)
            {
                $order= new Order;
                $order->user_id= auth()->user()->id;
                $order->item_id= $cartItem->item->id;
                $order->payment_id= $response['id'];
                $order->payment_method='Stripe';
                $order->payment_status= $response['status'];
                $order->amount = $cartItem->item->price * $cartItem->quantity;
                $order->quantity= $cartItem->quantity;
                $order->save();
                Cart::where([
                    'user_id' => auth()->user()->id,
                ])
                ->delete();

                $item= Item::whereId($cartItem->item->id);
                $item->update(['quantity'=> $cartItem->item->quantity - $cartItem->quantity]);
            }
        return redirect($response->url);
    }

    public function success()
    {
        return redirect()->route('cart')->with('success', 'Articolo/i ordinato/i con successo');
    }

    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Errore ricezione ordine');

    }

    public function productNotAviable()
    {
        $cartItems = Cart::where([
            'user_id' => auth()->user()->id,
        ])
        ->get();

        foreach ($cartItems as $cartItem)
        {            
            if ($cartItem->item->quantity < $cartItem->quantity){
                return true;
            }
        }
        return false;
    }
}

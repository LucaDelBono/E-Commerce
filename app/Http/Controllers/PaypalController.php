<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        if($this->productNotAviable()){
            return back()->with('error','Quantità articoli non disponibile');
        }
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent"=> "CAPTURE",
            "application_context"=> [
                
                "return_url"=> route('success'),
                "cancel_url"=> route('cancel')
            ],
            "purchase_units"=> [
              [
                "amount"=> [
                    "currency_code"=> "USD",
                    "value"=> $request->totalPrice
                ]
              ]
            ]
        ]);
        if(isset($response['id']) && $response != null)
        {
            foreach($response['links'] as $link)
            {
                if($link['rel'] == 'approve')
                {
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response=$provider->capturePaymentOrder($request->token);
        //dd($response);

        if(isset($response['status']) && $response['status'] == 'COMPLETED')
        {
            $cartItems = Cart::where([
                'user_id' => auth()->user()->id,
            ])
            ->with('item')
            ->get();

            foreach($cartItems as $cartItem)
            {
                $order= new Order;
                $order->user_id= auth()->user()->id;
                $order->item_id= $cartItem->item->id;
                $order->payment_id= $response['id'];
                $order->payment_method='PayPal';
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
            return redirect()->route('cart')->with('success', 'Articolo ordinato con successo');
        }
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

    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Errore ricezione ordine');

    }
}

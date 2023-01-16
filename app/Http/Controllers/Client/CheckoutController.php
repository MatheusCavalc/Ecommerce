<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartBox = session()->get('cart');
        $categories = Category::all();
        $user_id = auth()->user()->id;
        $total_value = array_sum(array_map(fn ($item) => $item['total_price'], $cartBox));

        return Inertia::render('Client/Checkout', compact('cartBox', 'categories', 'total_value', 'user_id'));
    }

    public function placeOrder(Request $request)
    {
        //SAVING ORDER IN DB
        $data = $request->validate([
            'total_price' => 'required',
            'products' => 'required|array',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|numeric',
            'address1' => 'required|max:255',
            'address2' => 'nullable|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zipcode' => 'required',
            'created_by' => 'required',
        ]);

        $order = Order::create($data);

        //CHECKOUT (PAYMENT)
        Stripe::setApiKey(getenv('STRIPE_SECRET'));

        $lineItems = [];
        foreach ($request->products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product['name'],
                    ],
                    'unit_amount_decimal' => $product['price'] * 100,
                ],
                'quantity' => $product['qty'],
            ];
        }

        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['order_id' => $order->id], true) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure', ['order_id' => $order->id], true),
        ]);

        return Inertia::location($session->url);
    }

    public function success(Request $request)
    {
        $categories = Category::all();

        session()->flush();

        Stripe::setApiKey(getenv('STRIPE_SECRET'));

        $session = Session::retrieve($request->get('session_id'));

        Order::findOrFail($request->get('order_id'))->update([  //queue?
            'status_payment' => 'PAID',
            'stripe_payment_id' => $session->payment_intent
        ]);

        //send email //queue

        return Inertia::render('Client/Checkout/Success', compact('categories', 'session'));
    }

    public function failure(Request $request)
    {
        $categories = Category::all();

        Order::findOrFail($request->get('order_id'))->update([ //queue?
            'status_payment' => 'FAILED',
        ]);

        //send email //queue

        return Inertia::render('Client/Checkout/Failure', compact('categories'));

    }
}

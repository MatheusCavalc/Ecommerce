<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderDataEmailJob;
use App\Jobs\StoreOrderDataJob;
use App\Models\Category;
use App\Models\Order;
use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
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
        Stripe::setApiKey(getenv('STRIPE_SECRET'));

        $categories = Category::all();

        session()->forget('cart');

        $session = Session::retrieve($request->get('session_id'));

        $order = Order::findOrFail($request->get('order_id'));

        //Queue + Job
        StoreOrderDataJob::withChain([
            new SendOrderDataEmailJob($session->customer_details->email, $order)
        ])->dispatch($request->get('order_id'), PaymentStatus::Paid, ShippingStatus::Pending, $session->payment_intent, $session->customer_details->email);

        return Inertia::render('Client/Checkout/Success', compact('categories', 'session'));
    }

    public function failure(Request $request)
    {
        $categories = Category::all();

        new StoreOrderDataJob($request->get('order_id'), PaymentStatus::Failed, ShippingStatus::Pending);

        //send email //queue

        return Inertia::render('Client/Checkout/Failure', compact('categories'));
    }







    //MELHORAR VIEWS DE SUCCESSO E FALHA APOS CHECKOUT //foi
    //QUEUE + JOBS NO SUCESSO E FALHA PARA ENVIO DE EMAIL PARA CLIENTES //foi
    //INFOS NA INDEX DE ADMIN (VENDAS, PRODUTOS, CATEGORIAS E ETC IGUAL O PROJETO INVENTARIO) //foi
    //CRIAR ADMIN ORDERS (COMPLETO) //foi
    //WISHLIST //foi
    //MINHAS COMPRAS//foi


    //COMPONENTIZAR O MAXIMO POSSIVEL!!!
}

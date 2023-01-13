<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function payment(Request $request)
    {
        //FINALIZAR FORM NA PAGINA CHECKOUT, FINALIZAR METODO PAYMENT COM A ORDEM SALVA NO BANCO DE DADOS E STRIPE

        dd($request);
    }
}

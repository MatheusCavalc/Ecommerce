<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CartController extends Controller
{
    public function __construct(LayoutController $layoutController)
    {
        $this->middleware(function ($request, $next) use ($layoutController) {
            $layoutController->shareCommonData();
            return $next($request);
        });
    }

    public function index()
    {
        $cartBox = session()->get('cart');
        $categories = Category::all();
        $total_value = $cartBox == null ? 0 : array_sum(array_map(fn ($item) => $item['total_price'], $cartBox));
        $total_items = $cartBox == null ? 0 : array_sum(array_map(fn ($item) => $item['qty'], $cartBox));

        return Inertia::render('Client/Cart', compact('cartBox', 'categories', 'total_value', 'total_items'));
    }

    public function add(Product $product, $qty, LayoutController $layoutController)
    {
        $cart = session()->get('cart');

        $price = $product->on_sale == true ? $product->sale_price : $product->price;

        if (!$cart) {
            $cart = [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'qty' => $qty,
                    'price' => $price,
                    'total_price' => $price * $qty
                ]
            ];

            session()->put('cart', $cart);

            $total_items = $cart == null ? 0 : array_sum(array_map(fn ($item) => $item['qty'], $cart));
            //$layoutController->shareCommonData();
            return response()->json(['qty' => $total_items]);
            //return redirect()->route('cart.index');
        }

        if (isset($cart)) {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'qty' => $qty,
                'price' => $price,
                'total_price' => $price * $qty
            ];
            session()->put('cart', $cart);

            $total_items = $cart == null ? 0 : array_sum(array_map(fn ($item) => $item['qty'], $cart));
            //$layoutController->shareCommonData();
            return response()->json(['qty' => $total_items]);
            //return redirect()->route('cart.index');
        }
    }

    public function remove($product_id)
    {
        $cart = Session::get('cart');

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);


            $total_items = $cart == null ? 0 : array_sum(array_map(fn ($item) => $item['qty'], $cart));
            return redirect()->route('cart.index');
        }
    }

    public function updateQuantity(Request $request)
    {
        $cart = Session::get('cart');

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['qty'] = $request->qty;
            session()->put('cart', $cart);

            $total_items = $cart == null ? 0 : array_sum(array_map(fn ($item) => $item['qty'], $cart));
            return response()->json(['qty' => $total_items]);
            //return redirect()->route('cart.index');
        }
    }
}

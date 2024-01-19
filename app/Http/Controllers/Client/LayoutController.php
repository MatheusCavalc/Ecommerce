<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LayoutController extends Controller
{
    public function shareCommonData()
    {
        $categories = Category::all();
        $cart = session()->get('cart');
        $total_value = $cart == null ? 0 : array_sum(array_map(fn ($item) => $item['total_price'], $cart));

        Inertia::share('userData', [
            'categories' => $categories,
            'cart' => $cart,
            'total_value' => $total_value,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $categories = Category::count();
        $products = Product::count();
        $sales = Order::where('status_payment', '=', 'PAID')->count();

        return Inertia::render('Admin/Index', compact('users', 'categories', 'products', 'sales'));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Index', [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }
}

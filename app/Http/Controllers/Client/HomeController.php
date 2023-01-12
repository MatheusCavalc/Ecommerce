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
        $products = Product::query()
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return Inertia::render('Client/Index', [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    public function view_product(Product $product)
    {
        return Inertia::render('Client/ProductView', [
            'product' => $product,
            'categories' => Category::all(),
            'products' => Product::where('category_id', '=', $product->category_id)
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get()
        ]);
    }

    public function view_category(Category $category)
    {
        return Inertia::render('Client/CategoryView', [
            'categories' => Category::all(),
            'products' => Product::where('category_id', '=', $category->id)->get()
        ]);
    }
}

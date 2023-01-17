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
            ->where('published', '=', true)
            ->where('on_sale', '=', false)
            ->orderBy('updated_at', 'desc')
            ->get();

        $sale_products = Product::query()
            ->where('published', '=', true)
            ->where('on_sale', '=', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return Inertia::render('Client/Index', [
            'products' => $products,
            'sale_products' => $sale_products,
            'categories' => Category::all(),
        ]);
    }

    public function viewProduct(Product $product)
    {
        return Inertia::render('Client/ProductView', [
            'product' => $product,
            'categories' => Category::all(),
            'products' => Product::where('category_id', '=', $product->category_id)
                ->where('published', '=', true)
                ->where('id', '!=', $product->id)
                //->take(4)
                ->get()
        ]);
    }

    public function viewCategory(Category $category)
    {
        return Inertia::render('Client/CategoryView', [
            'categories' => Category::all(),
            'category' => $category->name,
            'products' => Product::where('category_id', '=', $category->id)
                ->where('published', '=', true)
                ->get()
        ]);
    }
}

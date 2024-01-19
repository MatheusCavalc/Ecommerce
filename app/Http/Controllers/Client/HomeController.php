<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
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
        ]);
    }

    public function viewProduct(Product $product)
    {
        return Inertia::render('Client/ProductView', [
            'product' => $product,
            'products' => Product::where('category_id', '=', $product->category_id)
                ->where('published', '=', true)
                ->where('id', '!=', $product->id)
                //->take(4)
                ->get()
        ]);
    }

    public function viewCategory(Category $category)
    {
        //dd($category);

        return Inertia::render('Client/CategoryView', [
            'category' => $category->name,
            'products' => Product::where('category_id', '=', $category->id)
                ->where('published', '=', true)
                ->get()
        ]);
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $products = Product::query()
            ->where('published', true)
            ->where('name', 'LIKE', "%{$search}%")
            ->Where('description', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return Inertia::render('Client/ProductSearch', compact('categories', 'search', 'products'));
    }

    public function dashboardIndex()
    {
        return Inertia::render('Client/Dashboard/Index', [
            'orders' => Order::where('created_by', auth()->user()->id)->get()
        ]);
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);

        if ($order->created_by != auth()->user()->id) {
            return abort(404);
        }

        return Inertia::render('Client/Dashboard/Order', [
            'order' => $order
        ]);
    }
}

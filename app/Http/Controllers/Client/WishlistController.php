<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WishlistController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $wishlist = Wishlist::where('user_id', '=', auth()->user()->id)->with('product')->get();

        return Inertia::render('Client/Wishlist/Index', compact('categories', 'wishlist'));
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');

        $data = Wishlist::where('product_id', $product_id)->where('user_id', auth()->user()->id)->exists();

        if (Product::find($product_id)) {
            if ($data) {
                return response()->json(['status' => 'Product is already in your wishlist']);
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product_id
                ]);
                return response()->json(['status' => 'Product add to your Wishlist']);
            }
        } else {
            return response()->json(['status' => 'Product doesnot exist']);
        }
    }

    public function remove(Request $request)
    {
        $product_id = $request->input('product_id');

        if (Wishlist::where('product_id', $product_id)->where('user_id', auth()->user()->id)) {
            $wish = Wishlist::where('product_id', $product_id)->where('user_id', auth()->user()->id);
            $wish->delete();
            $wishlist = Wishlist::where('user_id', '=', auth()->user()->id)->with('product')->get();
            return $wishlist;
        } else {
            return response()->json(['status' => 'Product doesnot exist']);
        }
    }
}

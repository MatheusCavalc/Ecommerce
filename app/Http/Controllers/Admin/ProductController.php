<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Product/Index', [
            'products' => Product::with('category')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Product/Create', [
            'categories' => Category::all(),
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
            'description' => 'required|max:1000',
            'price' => 'required|decimal:2',
            'published' => 'required',
            'created_by' => 'required',
        ]);

        if ($data['image']) {
            $data['image'] = FacadesRequest::file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect('admin/products')->with('message', 'Product created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $image = asset('storage/' . $product->image);

        return Inertia::render('Product/Show', compact('product', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $image = asset('storage/' . $product->image);
        $user_id = auth()->user()->id;

        return Inertia::render('Admin/Product/Edit', compact('product', 'categories', 'image', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = is_string($request->image) ? 'nullable|string' : 'nullable|image|mimes:jpg,png,jpeg,webp|max:1024';

        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'image' => $rule,
            'description' => 'required|max:1000',
            'price' => 'required|decimal:2',
            'published' => 'required',
            'updated_by' => 'required',
        ]);

        $data['image'] = $request->image;

        if (FacadesRequest::file('image')) {
            $data['image'] = FacadesRequest::file('image')->store('products', 'public');
        }

        Product::findOrFail($id)->update($data);

        return redirect('admin/products')->with('message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        return redirect()->back()
            ->with('message', 'Product delete');
    }
}

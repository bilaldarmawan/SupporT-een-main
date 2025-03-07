<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $products = Product::all();
        return view('admin.page.products.index', compact('products'))->with('title', 'Products index');
    }

    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.page.products.show', compact('product'))->with('title', 'Products show');
    }

    public function create()
    {
        return view('admin.page.products.create')->with('title', 'Products Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required|string',
            'harga' => 'required|numeric',
            'size' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Product::create([
            'nama_product' => $request->input('nama_product'),
            'harga' => $request->input('harga'),
            'size' => $request->input('size'),
            'image' => $imageName,
            'type' => $request->input('type'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.page.products.edit', compact('product'))->with('title', 'Products edit');
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'nama_product' => 'required|string',
            'harga' => 'required|numeric',
            'size' => 'required|string',
            'type' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($product_id);

        $data = [
            'nama_product' => $request->nama_product,
            'harga' => $request->harga,
            'size' => $request->size,
            'type' => $request->type,
        ];

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

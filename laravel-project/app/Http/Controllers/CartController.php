<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::where('product_id', $id)->first(); // Menggunakan 'product_id' untuk pencarian
        Cart::add([
            'id' => $product->product_id, // Sesuaikan dengan 'product_id'
            'name' => $product->nama_product,
            'price' => $product->harga,
            'quantity' => 1,
            'attributes' => ['image' => $product->image]
        ]);

        return redirect()->route('cart.index');
    }

    public function index()
    {
        $cartItems = Cart::getContent();
        return view('user.page.cart.index', compact('cartItems'), [
            'title' => 'Halaman Keranjang',
        ]);
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $request->qty]
        ]);

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index');
    }
}

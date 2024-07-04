<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Cart
{
    public static function add($product, $qty)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->nama_product,
                'price' => $product->harga,
                'image' => $product->image,
                'qty' => $qty,
            ];
        }
        
        Session::put('cart', $cart);
    }

    public static function update($product_id, $qty)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product_id])) {
            $cart[$product_id]['qty'] = $qty;
        }
        
        Session::put('cart', $cart);
    }

    public static function remove($product_id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }
        
        Session::put('cart', $cart);
    }

    public static function clear()
    {
        Session::forget('cart');
    }

    public static function getCart()
    {
        return Session::get('cart', []);
    }

    public static function getTotal()
    {
        $cart = self::getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return $total;
    }

    public static function getTotalQuantity()
    {
        $cart = self::getCart();
        $totalQty = 0;

        foreach ($cart as $item) {
            $totalQty += $item['qty'];
        }

        return $totalQty;
    }
}

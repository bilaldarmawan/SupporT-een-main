<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class transaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data transaksi
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Simpan data transaksi ke database
        $transaksi = Transaction::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'total' => $request->total,
        ]);

        // Simpan data produk yang dibeli ke tabel transaksi_details
        foreach (Cart::getContent() as $item) {
            $transaksi->details()->create([
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Hapus item keranjang belanja setelah transaksi berhasil
        Cart::clear();

        return response()->json(['message' => 'Transaksi berhasil'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\Order; 
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showReceipt($orderId)
    {
        // Logic untuk menampilkan resi berdasarkan orderId
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->firstOrFail();
        return view('user.page.purchase.receipt', compact('order'));
    }

    public function history()
    {
        // Logic untuk menampilkan history pembelian
        $transactions = Transaction::where('id', Auth::id())->get();
        return view('user.page.purchase.history', compact('transactions'), [
            'title' => 'Halaman Riwayat Transaksi',
        ]);
    }
}

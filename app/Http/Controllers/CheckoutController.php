<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $cartItems = Cart::getContent();
        return view('user.page.checkout.index', [
            'cartItems' => $cartItems,
            'title' => 'Halaman Checkout',
        ]);
    }

    public function showCheckoutForm()
    {
        $cartItems = Cart::getContent();
        return view('user.page.checkout.index', [
            'cartItems' => $cartItems,
            'title' => 'Halaman Checkout',
        ]);
    }

    public function processCheckout(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
    ]);

    $cartItems = Cart::getContent();
    $total = Cart::getTotal();

    // Log the total value
    Log::info('Cart total: ' . $total);

    // Ensure cart is not empty and total is valid
    if ($cartItems->isEmpty() || $total <= 0) {
        return back()->with('error', 'Keranjang belanja kosong atau total tidak valid.');
    }

    // Midtrans configuration
    Config::$serverKey = config('services.midtrans.serverKey');
    Config::$isProduction = config('services.midtrans.isProduction');
    Config::$isSanitized = config('services.midtrans.isSanitized');
    Config::$is3ds = config('services.midtrans.is3ds');

    $params = [
        'transaction_details' => [
            'order_id' => uniqid(),
            'gross_amount' => $total,
        ],
        'customer_details' => [
            'first_name' => $validatedData['nama'],
            'last_name' => '',
            'email' => $request->user()->email ?? 'customer@example.com',
            'phone' => $validatedData['no_hp'],
        ],
    ];

    try {
        // Get Snap Token from Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Create transaction in your database with Snap Token
        $transaction = Transaction::create([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'total' => $total,
            'snap_token' => $snapToken, // Save Snap Token to database
        ]);

        foreach ($cartItems as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        return view('user.page.checkout.payment', [
            'snapToken' => $snapToken,
            'cartItems' => $cartItems,
            'title' => 'Halaman Checkout',
        ]);
    } catch (\Exception $e) {
        Log::error('Midtrans error: ' . $e->getMessage());
        return back()->with('error', 'Error processing payment: ' . $e->getMessage());
    }
}
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::find($request->order_id);

            if ($transaction) {
                $transaction->update(['status' => $request->transaction_status]);

                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    Cart::clear();
                    return redirect()->route('home')->with('success', 'Pembayaran berhasil.');
                }
            }
        }

        return redirect()->route('home')->with('error', 'Pembayaran gagal.');
    }
}

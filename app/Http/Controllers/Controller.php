<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('user.page.index', [
            'title' => 'Halaman Utama',
        ]);
    }

    public function home()
    {
        return view('user.page.home', [
            'title' => 'Halaman Home',
        ]);
    }

    public function jasa()
    {
        return view('user.page.jasa', [
            'title' => 'Jasa',
        ]);
    }

    public function transaksi()
    {
        return view('user.page.transaksi', [
            'title' => 'Transaksi',
        ]);
    }

    public function contact()
    {
        return view('user.page.contact', [
            'title' => 'Kontak',
        ]);
    }

    public function checkout()
    {
        return view('user.page.checkout.index', [
            'title' => 'Checkout',
        ]);
    }

    public function admin()
    {
        return view('admin.page.dashboard', [
            'title' => 'Dashboard Admin',
        ]);
    }

    public function product()
    {
        $products = Product::all();
        return view('admin.page.products.index', [
            'products' => $products,
            'title' => 'Produk Admin',
        ]);
    }

    public function report()
    {
        return view('admin.page.report', [
            'title' => 'Laporan Admin',
        ]);
    }
}
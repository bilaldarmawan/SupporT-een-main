<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class JasaController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('user.page.jasa', compact('products'))->with('title', 'Jasa');
    }
}


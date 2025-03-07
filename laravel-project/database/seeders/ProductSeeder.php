<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Data dummy produk
        $products = [
            [
                'nama_product' => 'Produk Contoh 1',
                'harga' => 100000,
                'size' => 'L',
                'image' => 'produk-contoh-1.jpg',
                'type' => 'Jenis Contoh'
            ],
            [
                'nama_product' => 'Produk Contoh 2',
                'harga' => 200000,
                'size' => 'M',
                'image' => 'produk-contoh-2.jpg',
                'type' => 'Jenis Contoh'
            ],
            // Tambahkan lebih banyak data produk di sini
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

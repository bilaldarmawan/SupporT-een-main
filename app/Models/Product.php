<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'nama_product',
        'harga',
        'size',
        'image',
        'type',
    ];

    // Jika Anda menggunakan primary key berbeda
    protected $primaryKey = 'product_id';

    // Jika primary key bukan auto increment
    public $incrementing = false;

    // Jika primary key bukan integer
    protected $keyType = 'string';
}

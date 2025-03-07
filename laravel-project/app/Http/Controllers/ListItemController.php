<?php
// app/Http/Controllers/ListItemController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ListItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('list_item', compact('items'));
    }
}
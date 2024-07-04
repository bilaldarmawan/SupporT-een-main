<?php

// app/Http/Controllers/UserManagementController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.page.users.index', compact('users'),['title' => 'Halaman Tambah User',
        ]);
    }

}

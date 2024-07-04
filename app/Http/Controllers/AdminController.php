<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.page.users.index', compact('users'), ['title' => 'Kelola Pengguna']);
    }

    public function createUser()
    {
        $title = 'Create User';
        return view('admin.page.users.create', compact('title'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.page.users.index')->with('success', 'User created successfully');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $title = 'Edit User';
        return view('admin.page.users.edit', compact('user', 'title'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.page.users.index')->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.page.users.index')->with('success', 'User deleted successfully');
    }

    public function promoteUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->route('admin.page.users.index')->with('success', 'User promoted to admin');
    }

    // Tambahkan metode berikut:
    public function transactionHistory()
    {
        // Ambil semua transaksi
        $transactions = Transaction::with('details.product')->get();
    return view('admin.page.transactions.history', compact('transactions'), [
            'title' => 'Halaman Utama',
        ]);
    }

    public function updateTransactionStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        // Update status transaksi
        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
    public function print($id)
{
    $transaction = Transaction::findOrFail($id);
    // return view untuk halaman cetak, atau generate PDF, atau menggunakan teknik cetak lainnya
    return view('admin.page.transactions.print', compact('transaction'));
}
public function printPDF($id)
{
    $transaction = Transaction::findOrFail($id);

    // Setelah mendapatkan data transaksi, buat objek Dompdf
    $pdf = new Dompdf();
    
    // Buat konten PDF dari view blade
    $pdf->loadHtml(view('admin.page.transactions.print', compact('transaction'))->render());
    
    // Atur opsi PDF jika diperlukan
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $pdf->setOptions($options);

    // Render PDF (akan menghasilkan output berupa string)
    $pdf->render();

    // Output PDF ke browser atau simpan ke file jika diinginkan
    return $pdf->stream("transaction_$id.pdf");
}
}

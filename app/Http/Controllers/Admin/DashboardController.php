<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index() {
        date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu ke Indonesia (Waktu Indonesia Barat)
        
        $currentTime = date('Y-m-d'); // Mendapatkan waktu saat ini dalam format YYYY-mm-dd HH:ii:ss
        
        $category = Category::count();
        $product = Product::count();
        $userCount = User::where('role', 'user')->count();
        $users = User::all(); // Mendapatkan semua user
    
        return view('pages.admin.index', compact(
            'category',
            'product',
            'userCount',
            'users', // Menambahkan $users ke compact
            'currentTime',
        ));
    }
    

    public function showUsers()
    {
        $users = User::all();
        return view('pages.admin.users', compact('users')); // Perbaiki compact('user') menjadi compact('users')
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make('password'); // Set default password 'password'
        $user->save();
        return redirect()->back()->with('success', 'Password reset successfully.');
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}

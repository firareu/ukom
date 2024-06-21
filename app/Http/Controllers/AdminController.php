<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Mengambil semua user dengan role 'admin'
        $admins = User::where('role', 'admin')->get();

        return view('items.index', [
            'admins' => $admins
        ]);
    }
}

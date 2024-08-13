<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\AuthController;
use App\Models\Admin;

class WebController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    public function dashboard()
    {
        // if (!AuthController::class) {
        //     return redirect()->route('login');
        // }
        return view('dashboard');
    }

    public function logout(Request $request)
    {
    if ($user = $request->user()) {
        $user->token()->revoke();
        return redirect()->route('login')->with('status', 'Anda telah logout.');
    }

    return redirect()->route('login')->with('error', 'Tidak ada pengguna yang terautentikasi.');
}


}

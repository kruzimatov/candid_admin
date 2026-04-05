<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin_user')) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $adminEmail    = config('admin.email');
        $adminPassword = config('admin.password');

        if ($request->email !== $adminEmail || $request->password !== $adminPassword) {
            return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput();
        }

        Session::put('admin_user', [
            'email' => $adminEmail,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Session::forget('admin_user');
        return redirect()->route('admin.login');
    }
}

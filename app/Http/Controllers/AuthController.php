<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (!Auth::user()->is_admin) {
                Auth::logout();

                return back()
                    ->withErrors([
                        'username' => 'Tài khoản không có quyền quản trị.',
                    ])
                    ->onlyInput('username');
            }

            return redirect()->intended(route('admin.posts.index'));
        }

        return back()
            ->withErrors([
                'username' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
            ])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

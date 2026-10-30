<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 1. GHI LOG THỜI GIAN ĐĂNG KÝ
        Log::info('Người dùng đăng ký thành công', [
            'email' => $user->email,
            'registered_at' => now(),
        ]);

        // 2. GỬI MAIL CHÀO MỪNG QUA MAILTRAP
        Mail::to($user->email)->send(new WelcomeMail($user));

        Auth::login($user);

        return redirect()->route('posts.index')->with('success', 'Đăng ký tài khoản thành công! Email chào mừng đã được gửi.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // 3. GHI LOG THỜI GIAN ĐĂNG NHẬP
            Log::info('Người dùng đăng nhập thành công', [
                'email' => Auth::user()->email,
                'login_at' => now(),
            ]);

            return redirect()->intended(route('posts.index'))->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // --- BỔ SUNG: GIAO DIỆN QUÊN MẬT KHẨU ---
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // --- BỔ SUNG: XỬ LÝ QUÊN MẬT KHẨU & GỬI MAIL CẤP LẠI ---
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.'
        ]);

        $user = User::where('email', $request->email)->first();

        // Tạo mật khẩu ngẫu nhiên mới
        $newPassword = Str::random(8);

        // Cập nhật mật khẩu mới vào database
        $user->password = Hash::make($newPassword);
        $user->save();

        // 4. GHI LOG THỜI GIAN CẤP LẠI MẬT KHẨU
        Log::info('Người dùng yêu cầu cấp lại mật khẩu mới', [
            'email' => $user->email,
            'password_reset_at' => now(),
        ]);

        // 5. GỬI MAIL CHỨA MẬT KHẨU MỚI QUA MAILTRAP
        Mail::to($user->email)->send(new ResetPasswordMail($newPassword));

        return back()->with('success', 'Mật khẩu mới đã được gửi vào email của bạn (kiểm tra Mailtrap)!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('posts.index')->with('success', 'Đã đăng xuất thành công.');
    }
}
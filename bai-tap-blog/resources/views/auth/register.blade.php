@extends('layouts.app')
@section('title', 'Đăng ký tài khoản - TechInsights')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8 my-12">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Tạo tài khoản mới</h1>
        <p class="text-slate-500 text-sm mt-1">Tham gia cộng đồng chia sẻ kiến thức IT</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Họ và tên</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ tên của bạn"
                class="w-full px-4 py-2.5 rounded-lg border @error('name') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
            @error('name')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Địa chỉ Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                class="w-full px-4 py-2.5 rounded-lg border @error('email') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
            @error('email')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu</label>
            <input type="password" name="password" placeholder="Tối thiểu 6 ký tự"
                class="w-full px-4 py-2.5 rounded-lg border @error('password') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
            @error('password')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl shadow-sm transition">
            Đăng ký ngay
        </button>
    </form>

    <p class="text-center text-sm text-slate-600 mt-6">
        Đã có tài khoản? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">Đăng nhập</a>
    </p>
</div>
@endsection
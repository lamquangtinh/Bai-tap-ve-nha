@extends('layouts.app')
@section('title', 'Quên mật khẩu - TechInsights')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8 my-12">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Khôi phục mật khẩu</h1>
        <p class="text-slate-500 text-sm mt-1">Nhập email của bạn để nhận mật khẩu mới qua hệ thống</p>
    </div>

    <!-- Hiển thị thông báo thành công khi đã gửi mail -->
    @if (session('success'))
        <div class="mb-6 p-4 text-sm text-emerald-700 bg-emerald-50 rounded-lg border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Địa chỉ Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                class="w-full px-4 py-2.5 rounded-lg border @error('email') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
            @error('email')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl shadow-sm transition">
            Gửi mật khẩu mới
        </button>
    </form>

    <p class="text-center text-sm text-slate-600 mt-6">
        Đã nhớ mật khẩu? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">Đăng nhập ngay</a>
    </p>
</div>
@endsection
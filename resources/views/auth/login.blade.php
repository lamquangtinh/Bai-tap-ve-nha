
@extends('layouts.app')

@section('title', 'Đăng nhập quản trị | Tình Kendy')

@section('content')
<div class="container" style="max-width: 450px; margin: 60px auto;">
    <h1 style="margin-bottom: 10px;">Đăng nhập quản trị</h1>
    <p>Đăng nhập để quản lý bài viết của Tình Kendy.</p>

    @if ($errors->any())
        <div style="color: #b91c1c; margin: 15px 0;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div style="margin-bottom: 18px;">
            <label for="username">Tên đăng nhập</label>
            <input
                id="username"
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
                autofocus
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:6px;"
            >
        </div>

        <div style="margin-bottom: 18px;">
            <label for="password">Mật khẩu</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:6px;"
            >
        </div>

        <label style="display:block; margin-bottom:18px;">
            <input type="checkbox" name="remember" value="1">
            Ghi nhớ đăng nhập
        </label>

        <button type="submit" style="padding:12px 20px; cursor:pointer;">
            Đăng nhập
        </button>
    </form>
</div>
@endsection

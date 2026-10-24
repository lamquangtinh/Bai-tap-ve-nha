
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tình Kendy | Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="nav container">
            <a class="brand" href="{{ route('home') }}">Tình Kendy<span>.</span></a>

            <nav>
                <a href="{{ route('home') }}">Trang chủ</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.posts.index') }}">Quản trị</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="nav-button">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Quản trị viên</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="container alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="container alert error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <p>© {{ date('Y') }} Tình Kendy · Chia sẻ những điều mình yêu thích.</p>
    </footer>
</body>
</html>

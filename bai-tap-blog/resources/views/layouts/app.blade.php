<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechInsights - Chia Sẻ Kiến Thức IT & Lập Trình')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800 flex flex-col min-h-screen">

    <!-- Top Navigation Bar (Chuẩn style Sensive Blog) -->
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo Blog IT -->
                <a href="{{ route('posts.index') }}" class="text-2xl font-black tracking-tight text-slate-900 flex items-center gap-2">
                    <span class="bg-indigo-600 text-white p-1.5 rounded-lg text-lg">&lt;/&gt;</span>
                    <span>Tech<span class="text-indigo-600">Insights</span></span>
                </a>

                <!-- Menu điều hướng giữa -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                    <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">Trang chủ</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">Laravel & PHP</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">Full-stack</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">Kinh nghiệm IT</a>
                </nav>

                <!-- Menu Phải (Auth & Viết bài) -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('posts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full text-sm font-medium transition shadow-sm">
                            + Viết bài IT
                        </a>
                        <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                            <span class="text-sm font-medium text-slate-700 hidden sm:inline">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-xs text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-lg transition font-medium">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="bg-slate-900 hover:bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium transition">
                            Đăng ký
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Message -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <!-- Nội dung trang -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer chuẩn Blog -->
    <footer class="bg-slate-900 text-slate-400 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
            <div>
                <h3 class="text-white font-bold text-base mb-3">TechInsights Blog</h3>
                <p>Nơi chia sẻ kiến thức lập trình thực chiến, công nghệ web hiện đại và kinh nghiệm phát triển phần mềm từ cộng đồng.</p>
            </div>
            <div>
                <h3 class="text-white font-bold text-base mb-3">Chuyên mục chính</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Lập trình Laravel & PHP</a></li>
                    <li><a href="#" class="hover:text-white transition">Cơ sở dữ liệu & MySQL</a></li>
                    <li><a href="#" class="hover:text-white transition">Kinh nghiệm phỏng vấn IT</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-bold text-base mb-3">&copy; {{ date('Y') }} TechInsights.</h3>
                <p>Xây dựng với Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

</body>
</html>
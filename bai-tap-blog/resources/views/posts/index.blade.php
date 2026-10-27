@extends('layouts.app')
@section('title', 'TechInsights - Chia sẻ kiến thức IT')

@section('content')
<!-- Hero Banner lớn phong cách Sensive Blog -->
<section class="relative bg-slate-900 text-white py-24 px-4 sm:px-6 lg:px-8 mb-16 overflow-hidden">
    <div class="absolute inset-0 opacity-30 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/80 to-transparent"></div>

    <div class="max-w-7xl mx-auto relative z-10 text-center sm:text-left">
        <span class="bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-4">
            IT Knowledge & Tutorials
        </span>
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 max-w-3xl leading-tight">
            Xây dựng tư duy và kỹ năng lập trình hiện đại.
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl mb-8">
            Tổng hợp các bài viết chia sẻ về Laravel, kiến trúc hệ thống, kinh nghiệm thực chiến và thủ thuật tối ưu mã nguồn từ cộng đồng.
        </p>
        @auth
            <a href="{{ route('posts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3.5 rounded-xl font-semibold transition shadow-lg inline-flex items-center gap-2">
                Bắt đầu viết bài chia sẻ ngay &rarr;
            </a>
        @else
            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3.5 rounded-xl font-semibold transition shadow-lg inline-flex items-center gap-2">
                Tham gia cộng đồng ngay &rarr;
            </a>
        @endauth
    </div>
</section>

<!-- Danh sách bài viết dạng Lưới -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="flex items-center justify-between mb-10 border-b border-slate-100 pb-4">
        <h2 class="text-2xl font-bold text-slate-900">Bài viết mới nhất</h2>
        <span class="text-sm text-slate-500">Khám phá các chia sẻ kỹ thuật</span>
    </div>

    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 overflow-hidden flex flex-col group">
                    <a href="{{ route('posts.show', $post) }}" class="block h-52 overflow-hidden bg-slate-100 relative">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-400 font-mono text-xl font-bold">
                                &lt;Code/&gt;
                            </div>
                        @endif
                    </a>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                            <span class="font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md">
                                {{ $post->user->name }}
                            </span>
                            <span>•</span>
                            <span>{{ $post->created_at->format('d/m/Y') }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition line-clamp-2 mb-3">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h3>

                        <p class="text-slate-600 text-sm line-clamp-3 mb-6 flex-1 leading-relaxed">
                            {{ Str::limit($post->content, 110) }}
                        </p>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                            <a href="{{ route('posts.show', $post) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1">
                                Đọc bài viết <span>&rarr;</span>
                            </a>

                            @if(Auth::check() && Auth::id() === $post->user_id)
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="text-xs font-medium text-amber-600 hover:bg-amber-50 px-2.5 py-1 rounded transition">Sửa</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-rose-600 hover:bg-rose-50 px-2.5 py-1 rounded transition">Xóa</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-slate-50 rounded-2xl border border-dashed border-slate-300 p-16 text-center">
            <p class="text-slate-500 mb-4">Hiện chưa có bài viết kiến thức IT nào được đăng tải.</p>
            @auth
                <a href="{{ route('posts.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                    Đăng bài viết đầu tiên ngay!
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
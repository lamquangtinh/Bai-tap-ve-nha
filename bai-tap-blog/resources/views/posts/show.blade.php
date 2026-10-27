@extends('layouts.app')
@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto my-10 px-4 sm:px-0">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">
            <span>&larr;</span> Quay lại trang chủ
        </a>

        @if(Auth::check() && Auth::id() === $post->user_id)
            <div class="flex items-center gap-3">
                <a href="{{ route('posts.edit', $post) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition shadow-sm">
                    Chỉnh sửa
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition shadow-sm">
                        Xóa bài
                    </button>
                </form>
            </div>
        @endif
    </div>

    <article class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        @if($post->image)
            <div class="w-full max-h-[500px] overflow-hidden bg-slate-100">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-8 sm:p-12">
            <div class="flex items-center gap-3 text-sm text-slate-500 mb-6">
                <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-base">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-slate-900">{{ $post->user->name }}</p>
                    <p class="text-xs text-slate-400">Đăng ngày {{ $post->created_at->format('d/m/Y \l\ú\c H:i') }}</p>
                </div>
            </div>

            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight mb-8">
                {{ $post->title }}
            </h1>

            <div class="prose max-w-none text-slate-700 text-lg leading-relaxed space-y-6 whitespace-pre-line border-t border-slate-100 pt-8">
                {{ $post->content }}
            </div>
        </div>
    </article>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4 py-16">
    <div class="bg-indigo-50 text-indigo-600 font-bold text-6xl md:text-8xl px-6 py-4 rounded-2xl mb-6 shadow-inner">
        404
    </div>
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
        Oops! Không tìm thấy trang bạn yêu cầu
    </h1>
    <p class="text-gray-600 max-w-md mb-8">
        Có vẻ như đường dẫn bạn truy cập không tồn tại hoặc bài viết này đã bị gỡ bỏ khỏi hệ thống TechInsights.
    </p>
    <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition shadow-md">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Quay về Trang chủ
    </a>
</div>
@endsection
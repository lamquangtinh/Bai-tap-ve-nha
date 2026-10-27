@extends('layouts.app')
@section('title', 'Viết bài mới - TechInsights')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8 my-10">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Tạo bài viết kiến thức mới</h1>
            <p class="text-sm text-slate-500 mt-1">Chia sẻ kinh nghiệm lập trình hoặc thủ thuật công nghệ</p>
        </div>
        <a href="{{ route('posts.index') }}" class="text-sm text-slate-500 hover:text-slate-800 font-medium">&larr; Quay lại</a>
    </div>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tiêu đề bài viết <span class="text-rose-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Ví dụ: Hướng dẫn cấu hình Laravel Eloquent Relationships..."
                class="w-full px-4 py-3 rounded-xl border @error('title') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            @error('title')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ảnh bìa bài viết (Tùy chọn)</label>
            <input type="file" name="image" accept="image/*"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-300 rounded-xl p-1.5 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Định dạng hỗ trợ: JPG, PNG, WEBP. Dung lượng tối đa: 2MB.</p>
            @error('image')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nội dung bài viết <span class="text-rose-500">*</span></label>
            <textarea name="content" rows="10" placeholder="Viết nội dung chia sẻ chi tiết tại đây..."
                class="w-full px-4 py-3 rounded-xl border @error('content') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('posts.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition">
                Hủy bỏ
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition">
                Đăng bài viết ngay
            </button>
        </div>
    </form>
</div>
@endsection
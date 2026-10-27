@extends('layouts.app')
@section('title', 'Chỉnh sửa: ' . $post->title)

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8 my-10">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Chỉnh sửa bài viết</h1>
            <p class="text-sm text-slate-500 mt-1">Cập nhật nội dung hoặc thay đổi ảnh bìa mới</p>
        </div>
        <a href="{{ route('posts.show', $post) }}" class="text-sm text-slate-500 hover:text-slate-800 font-medium">&larr; Quay lại</a>
    </div>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tiêu đề bài viết <span class="text-rose-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                class="w-full px-4 py-3 rounded-xl border @error('title') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            @error('title')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ảnh bìa bài viết</label>
            @if($post->image)
                <div class="mb-3">
                    <p class="text-xs text-slate-500 mb-1.5 font-medium">Ảnh hiện tại:</p>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="h-40 rounded-xl object-cover border border-slate-200">
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-300 rounded-xl p-1.5 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Để trống nếu muốn giữ nguyên ảnh cũ. Tối đa 2MB.</p>
            @error('image')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nội dung bài viết <span class="text-rose-500">*</span></label>
            <textarea name="content" rows="10"
                class="w-full px-4 py-3 rounded-xl border @error('content') border-rose-500 bg-rose-50 @else border-slate-300 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('posts.show', $post) }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition">
                Hủy bỏ
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition">
                Lưu thay đổi
            </button>
        </div>
    </form>
</div>
@endsection
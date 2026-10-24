
@extends('layouts.app')

@section('title', 'Tạo bài viết mới | Tình Kendy')

@section('content')
<div class="container" style="max-width: 900px; margin: 40px auto;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <p style="color:#8b5e83; margin-bottom:8px;">QUẢN TRỊ NỘI DUNG</p>
            <h1 style="margin:0;">Tạo bài viết mới</h1>
        </div>

        <a href="{{ route('admin.posts.index') }}"
           style="text-decoration:none; color:#555;">
            ← Quay lại
        </a>
    </div>

    @if ($errors->any())
        <div style="background:#fff0f0; color:#a12626; padding:15px; border-radius:8px; margin-bottom:20px;">
            <strong>Vui lòng kiểm tra lại:</strong>
            <ul style="margin-bottom:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}"
          method="POST"
          enctype="multipart/form-data"
          style="background:white; padding:28px; border-radius:14px; box-shadow:0 4px 20px rgba(0,0,0,0.05);">

        @csrf

        {{-- Tiêu đề --}}
        <div style="margin-bottom:22px;">
            <label for="title" style="display:block; font-weight:600; margin-bottom:8px;">
                Tiêu đề bài viết *
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
                maxlength="255"
                placeholder="Nhập tiêu đề bài viết..."
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >
        </div>

        {{-- Đường dẫn --}}
        <div style="margin-bottom:22px;">
            <label for="slug" style="display:block; font-weight:600; margin-bottom:8px;">
                Đường dẫn (có thể để trống)
            </label>

            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug') }}"
                maxlength="255"
                placeholder="Ví dụ: chia-se-kinh-nghiem"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >

            <small style="color:#777;">
                Để trống, hệ thống sẽ tự tạo đường dẫn từ tiêu đề.
            </small>
        </div>

        {{-- Mô tả ngắn --}}
        <div style="margin-bottom:22px;">
            <label for="excerpt" style="display:block; font-weight:600; margin-bottom:8px;">
                Mô tả ngắn
            </label>

            <textarea
                id="excerpt"
                name="excerpt"
                rows="3"
                maxlength="500"
                placeholder="Viết đoạn giới thiệu ngắn cho bài viết..."
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >{{ old('excerpt') }}</textarea>
        </div>

        {{-- Ảnh bìa --}}
        <div style="margin-bottom:22px;">
            <label for="image" style="display:block; font-weight:600; margin-bottom:8px;">
                Ảnh bìa bài viết
            </label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px dashed #bbb; border-radius:8px;"
            >

            <small style="display:block; color:#777; margin-top:8px;">
                Hỗ trợ JPG, JPEG, PNG, WEBP; dung lượng tối đa 5 MB.
            </small>

            <div id="image-preview-container" style="display:none; margin-top:15px;">
                <p style="font-weight:600;">Xem trước ảnh bìa:</p>
                <img
                    id="image-preview"
                    src=""
                    alt="Xem trước ảnh bìa"
                    style="max-width:100%; max-height:350px; object-fit:contain; border-radius:10px;"
                >
                <div>
                    <button
                        type="button"
                        id="remove-image"
                        style="margin-top:10px; padding:8px 12px; border:0; border-radius:6px; background:#f3e5e5; cursor:pointer;"
                    >
                        Bỏ ảnh đã chọn
                    </button>
                </div>
            </div>
        </div>

        {{-- Nội dung --}}
        <div style="margin-bottom:22px;">
            <label for="content" style="display:block; font-weight:600; margin-bottom:8px;">
                Nội dung bài viết *
            </label>

            <textarea
                id="content"
                name="content"
                rows="14"
                required
                placeholder="Nhập nội dung bài viết..."
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px; line-height:1.7;"
            >{{ old('content') }}</textarea>

            <small style="color:#777;">
                Đây là ô nhập văn bản thông thường. Ở bước tiếp theo, mình sẽ bổ sung trình soạn thảo để chèn nhiều ảnh minh họa vào giữa nội dung.
            </small>
        </div>

        {{-- Trạng thái --}}
        <div style="margin-bottom:26px;">
            <label for="status" style="display:block; font-weight:600; margin-bottom:8px;">
                Trạng thái bài viết *
            </label>

            <select
                id="status"
                name="status"
                required
                style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; background:white;"
            >
                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                    Bản nháp — chưa công khai
                </option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                    Xuất bản — hiển thị trên trang chủ
                </option>
            </select>
        </div>

        {{-- Nút thao tác --}}
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <button
                type="submit"
                style="padding:12px 22px; border:0; border-radius:8px; background:#8b5e83; color:white; font-weight:600; cursor:pointer;"
            >
                Lưu bài viết
            </button>

            <a
                href="{{ route('admin.posts.index') }}"
                style="padding:12px 22px; border-radius:8px; background:#eee; color:#333; text-decoration:none;"
            >
                Hủy
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    const container = document.getElementById('image-preview-container');
    const removeButton = document.getElementById('remove-image');

    let previewUrl = null;

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            container.style.display = 'none';
            preview.removeAttribute('src');
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Vui lòng chọn một file ảnh hợp lệ.');
            this.value = '';
            container.style.display = 'none';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Ảnh vượt quá 5 MB. Vui lòng chọn ảnh nhỏ hơn.');
            this.value = '';
            container.style.display = 'none';
            return;
        }

        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        container.style.display = 'block';
    });

    removeButton.addEventListener('click', function () {
        input.value = '';
        preview.removeAttribute('src');
        container.style.display = 'none';

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    });
});
</script>
@endsection


@extends('layouts.app')

@section('title', 'Sửa bài viết | Tình Kendy')

@section('content')
<div class="container" style="max-width:900px; margin:40px auto; padding:0 16px;">

    <div style="margin-bottom:24px;">
        <a href="{{ route('admin.posts.index') }}"
           style="color:#8b5e83; text-decoration:none;">
            ← Quay lại danh sách
        </a>

        <h1 style="margin-top:16px;">Sửa bài viết</h1>
        <p style="color:#777;">Cập nhật nội dung hoặc thay ảnh bìa bài viết.</p>
    </div>

    @if ($errors->any())
        <div style="padding:15px; background:#fff0f0; color:#a12626; border-radius:8px; margin-bottom:20px;">
            <strong>Vui lòng kiểm tra lại thông tin:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.posts.update', $post) }}"
        method="POST"
        enctype="multipart/form-data"
        style="background:white; padding:28px; border-radius:14px; box-shadow:0 4px 20px rgba(0,0,0,.05);"
    >
        @csrf
        @method('PUT')

        <div style="margin-bottom:22px;">
            <label for="title" style="display:block; font-weight:600; margin-bottom:8px;">
                Tiêu đề *
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $post->title) }}"
                required
                maxlength="255"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:22px;">
            <label for="slug" style="display:block; font-weight:600; margin-bottom:8px;">
                Đường dẫn
            </label>

            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug', $post->slug) }}"
                maxlength="255"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:22px;">
            <label for="excerpt" style="display:block; font-weight:600; margin-bottom:8px;">
                Mô tả ngắn
            </label>

            <textarea
                id="excerpt"
                name="excerpt"
                rows="3"
                maxlength="500"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px;"
            >{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div style="margin-bottom:22px;">
            <label style="display:block; font-weight:600; margin-bottom:10px;">
                Ảnh bìa hiện tại
            </label>

            @if($post->image)
                <img
                    src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->title }}"
                    style="display:block; max-width:100%; max-height:300px; object-fit:contain; border-radius:10px; margin-bottom:12px;"
                >
            @else
                <p style="color:#777;">Bài viết chưa có ảnh bìa.</p>
            @endif

            <label for="image" style="display:block; font-weight:600; margin-bottom:8px;">
                Chọn ảnh bìa mới (không bắt buộc)
            </label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px dashed #bbb; border-radius:8px;"
            >

            <small style="display:block; color:#777; margin-top:8px;">
                JPG, JPEG, PNG hoặc WEBP; tối đa 5 MB. Không chọn ảnh mới thì ảnh hiện tại được giữ nguyên.
            </small>

            <div id="preview-container" style="display:none; margin-top:15px;">
                <p style="font-weight:600;">Ảnh mới sẽ dùng:</p>
                <img
                    id="preview"
                    src=""
                    alt="Xem trước ảnh mới"
                    style="max-width:100%; max-height:300px; object-fit:contain; border-radius:10px;"
                >
            </div>
        </div>

        <div style="margin-bottom:22px;">
            <label for="content" style="display:block; font-weight:600; margin-bottom:8px;">
                Nội dung bài viết *
            </label>

            <textarea
                id="content"
                name="content"
                rows="14"
                required
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #ddd; border-radius:8px; line-height:1.7;"
            >{{ old('content', $post->content) }}</textarea>

            <small style="color:#777;">
                Trình soạn thảo chèn nhiều ảnh minh họa sẽ được bổ sung ở bước tiếp theo.
            </small>
        </div>

        <div style="margin-bottom:26px;">
            <label for="status" style="display:block; font-weight:600; margin-bottom:8px;">
                Trạng thái *
            </label>

            <select
                id="status"
                name="status"
                required
                style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; background:white;"
            >
                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>
                    Bản nháp
                </option>
                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>
                    Xuất bản
                </option>
            </select>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <button
                type="submit"
                style="padding:12px 22px; border:0; border-radius:8px; background:#8b5e83; color:white; font-weight:600; cursor:pointer;"
            >
                Lưu thay đổi
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
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');
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

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            alert('Vui lòng chọn ảnh JPG, JPEG, PNG hoặc WEBP.');
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
});
</script>
@endsection

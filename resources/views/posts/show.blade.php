
@extends('layouts.app')

@section('title', $post->title . ' | Tình Kendy')

@section('content')
<div class="container" style="max-width: 850px; margin: 40px auto;">

    <a href="{{ route('home') }}">← Quay lại trang chủ</a>

    <article style="margin-top: 25px;">
        <p class="eyebrow">TINH KENDY BLOG</p>

        <h1 style="font-size: 36px; line-height: 1.3;">
            {{ $post->title }}
        </h1>

        <p style="color: #777;">
            Ngày đăng: {{ $post->created_at->format('d/m/Y') }}
            @if($post->user)
                · {{ $post->user->name }}
            @endif
        </p>

        @if($post->image)
            <img
                src="{{ asset('storage/' . $post->image) }}"
                alt="{{ $post->title }}"
                style="width: 100%; max-height: 480px; object-fit: cover; border-radius: 12px; margin: 20px 0;"
            >
        @endif

        @if($post->excerpt)
            <p style="font-size: 18px; color: #555;">
                {{ $post->excerpt }}
            </p>
        @endif

        <div style="font-size: 17px; line-height: 1.9; white-space: pre-line;">{{ $post->content }}</div>
    </article>

    <hr style="margin: 40px 0;">

    <section id="binh-luan">
        <h2>Bình luận ({{ $post->comments->count() }})</h2>
        <p>Hãy chia sẻ cảm nghĩ của bạn về bài viết nhé.</p>

        @if(session('success'))
            <div style="padding: 12px; margin: 15px 0; background: #dcfce7; color: #166534; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="padding: 12px; margin: 15px 0; background: #fee2e2; color: #991b1b; border-radius: 8px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('comments.store', $post->slug) }}"
            method="POST"
            style="margin: 20px 0 35px;"
        >
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name">Tên của bạn *</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    maxlength="255"
                    required
                    style="display: block; width: 100%; box-sizing: border-box; padding: 12px; margin-top: 6px; border: 1px solid #ddd; border-radius: 8px;"
                >
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email">Email của bạn *</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    maxlength="255"
                    required
                    style="display: block; width: 100%; box-sizing: border-box; padding: 12px; margin-top: 6px; border: 1px solid #ddd; border-radius: 8px;"
                >
            </div>

            <div style="margin-bottom: 15px;">
                <label for="content">Nội dung bình luận *</label>
                <textarea
                    id="content"
                    name="content"
                    rows="5"
                    maxlength="3000"
                    required
                    placeholder="Nhập bình luận của bạn..."
                    style="display: block; width: 100%; box-sizing: border-box; padding: 12px; margin-top: 6px; border: 1px solid #ddd; border-radius: 8px; resize: vertical;"
                >{{ old('content') }}</textarea>
            </div>

            <button
                type="submit"
                style="padding: 12px 22px; background: #222; color: white; border: none; border-radius: 8px; cursor: pointer;"
            >
                Gửi bình luận
            </button>
        </form>

        <h3>Danh sách bình luận</h3>

        @forelse($post->comments as $comment)
            <div style="padding: 15px 0; border-bottom: 1px solid #eee;">
                <strong>{{ $comment->name }}</strong>

                <p style="white-space: pre-line;">{{ $comment->content }}</p>

                <small style="color: #777;">
                    {{ $comment->created_at->format('d/m/Y H:i') }}
                </small>
            </div>
        @empty
            <p>Chưa có bình luận nào. Hãy là người bình luận đầu tiên!</p>
        @endforelse
    </section>

</div>
@endsection

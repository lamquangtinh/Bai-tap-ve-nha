
@extends('layouts.app')

@section('title', 'Trang chủ | Tình Kendy')

@section('content')
<div class="container">
    <section class="hero">
        <p class="eyebrow">WELCOME TO MY BLOG</p>
        <h1>Mỗi câu chuyện đều<br>có điều đáng nhớ.</h1>
        <p>Nơi chia sẻ kiến thức, trải nghiệm và những góc nhìn của Tình Kendy.</p>
    </section>

    @if($featuredPost)
        <section class="featured">
            <p class="eyebrow">BÀI VIẾT NỔI BẬT</p>
            <h2>
                <a href="{{ route('posts.show', $featuredPost->slug) }}">
                    {{ $featuredPost->title }}
                </a>
            </h2>
            <p>{{ $featuredPost->excerpt }}</p>
            <a class="button" href="{{ route('posts.show', $featuredPost->slug) }}">Đọc bài viết →</a>
        </section>
    @endif

    <section class="posts-section">
        <div class="section-heading">
            <div>
                <p class="eyebrow">KHÁM PHÁ</p>
                <h2>Bài viết mới nhất</h2>
            </div>
        </div>

        @forelse($posts as $post)
            <article class="post-card">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                @endif

                <p class="post-date">{{ $post->created_at->format('d/m/Y') }}</p>
                <h3>
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p>{{ $post->excerpt }}</p>
                <a href="{{ route('posts.show', $post->slug) }}">Đọc tiếp →</a>
            </article>
        @empty
            <div class="empty-state">
                <h3>Chưa có bài viết nào</h3>
                <p>Các bài viết mới sẽ xuất hiện tại đây.</p>
            </div>
        @endforelse

        <div class="pagination">{{ $posts->links() }}</div>
    </section>
</div>
@endsection

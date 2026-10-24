
@extends('layouts.app')

@section('title', 'Quản lý bài viết | Tình Kendy')

@section('content')
<div class="container" style="max-width:1200px; margin:40px auto; padding:0 16px;">

    <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:28px;">
        <div>
            <p style="color:#8b5e83; margin-bottom:8px;">QUẢN TRỊ NỘI DUNG</p>
            <h1 style="margin:0;">Quản lý bài viết</h1>
            <p style="color:#777;">Danh sách bài viết trên website Tình Kendy.</p>
        </div>

        <a href="{{ route('admin.posts.create') }}"
           style="display:inline-block; padding:12px 18px; background:#8b5e83; color:white; text-decoration:none; border-radius:8px; font-weight:600;">
            + Tạo bài viết mới
        </a>
    </div>

    @if(session('success'))
        <div style="padding:14px 18px; background:#e8f7ed; color:#216e39; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding:14px 18px; background:#fff0f0; color:#a12626; border-radius:8px; margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    @if($posts->count() > 0)
        <div style="background:white; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.05); overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; min-width:760px;">
                <thead>
                    <tr style="background:#f8f5f8; text-align:left;">
                        <th style="padding:16px;">Ảnh bìa</th>
                        <th style="padding:16px;">Thông tin bài viết</th>
                        <th style="padding:16px;">Tác giả</th>
                        <th style="padding:16px;">Trạng thái</th>
                        <th style="padding:16px;">Ngày tạo</th>
                        <th style="padding:16px;">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr style="border-top:1px solid #eee;">
                            <td style="padding:16px; width:120px;">
                                @if($post->image)
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $post->title }}"
                                        style="width:100px; height:70px; object-fit:cover; border-radius:8px;"
                                    >
                                @else
                                    <div style="width:100px; height:70px; display:flex; align-items:center; justify-content:center; background:#f1edf1; color:#888; border-radius:8px; font-size:12px;">
                                        Chưa có ảnh
                                    </div>
                                @endif
                            </td>

                            <td style="padding:16px; max-width:300px;">
                                <strong>{{ $post->title }}</strong>
                                <p style="margin:6px 0 0; color:#777; font-size:13px;">
                                    {{ $post->slug }}
                                </p>
                            </td>

                            <td style="padding:16px;">
                                {{ $post->user->name ?? 'Không rõ' }}
                            </td>

                            <td style="padding:16px;">
                                @if($post->status === 'published')
                                    <span style="display:inline-block; padding:5px 9px; border-radius:20px; background:#e5f7eb; color:#247542; font-size:12px;">
                                        Đã xuất bản
                                    </span>
                                @else
                                    <span style="display:inline-block; padding:5px 9px; border-radius:20px; background:#fff2d9; color:#8a5b00; font-size:12px;">
                                        Bản nháp
                                    </span>
                                @endif
                            </td>

                            <td style="padding:16px; white-space:nowrap;">
                                {{ $post->created_at?->format('d/m/Y') }}
                            </td>

                            <td style="padding:16px;">
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <a
                                        href="{{ route('admin.posts.edit', $post) }}"
                                        style="padding:8px 11px; background:#eee8f1; color:#65466a; text-decoration:none; border-radius:6px;"
                                    >
                                        Sửa
                                    </a>

                                    <form
                                        action="{{ route('admin.posts.destroy', $post) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            style="padding:8px 11px; background:#fdeaea; color:#a12626; border:0; border-radius:6px; cursor:pointer;"
                                        >
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:24px;">
            {{ $posts->links() }}
        </div>
    @else
        <div style="padding:50px 20px; background:white; text-align:center; border-radius:12px;">
            <h3>Chưa có bài viết nào</h3>
            <p style="color:#777;">Hãy tạo bài viết đầu tiên cho website của bạn.</p>
            <a href="{{ route('admin.posts.create') }}"
               style="display:inline-block; margin-top:10px; padding:12px 18px; background:#8b5e83; color:white; text-decoration:none; border-radius:8px;">
                Tạo bài viết
            </a>
        </div>
    @endif

</div>
@endsection

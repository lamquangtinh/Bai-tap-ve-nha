<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'content' => ['required', 'string', 'max:3000'],
        ]);

        Comment::create([
            'post_id' => $post->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'content' => $data['content'],
            'status' => 'approved',
        ]);

        return redirect()
            ->to(route('posts.show', $post->slug) . '#binh-luan')
            ->with('success', 'Đã gửi bình luận thành công!');
    }
}

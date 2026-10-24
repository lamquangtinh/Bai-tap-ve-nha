<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')
            ->latest()
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    public function updateStatus(Comment $comment, string $status)
    {
        abort_unless(
            in_array($status, ['pending', 'approved', 'rejected'], true),
            404
        );

        $comment->update(['status' => $status]);

        return back()->with('success', 'Đã cập nhật trạng thái bình luận.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }
}

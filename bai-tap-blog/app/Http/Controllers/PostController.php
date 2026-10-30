<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'content.required' => 'Nội dung không được để trống.',
            'content.min' => 'Nội dung phải có ít nhất 10 ký tự.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh chỉ hỗ trợ định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        // 👈 2. CHÈN LOG KHI TẠO BÀI VIẾT THÀNH CÔNG
        Log::info('Bài viết mới đã được tạo thành công!', [
            'post_id' => $post->id,
            'title' => $post->title,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('posts.index')->with('success', 'Tạo bài viết mới thành công!');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            // Ghi log khi có người cố tình truy cập trái phép
            Log::warning('Cảnh báo truy cập trái phép chỉnh sửa bài viết!', [
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết của người khác!');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật bài viết của người khác!');
        }

        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'content.required' => 'Nội dung không được để trống.',
            'content.min' => 'Nội dung phải có ít nhất 10 ký tự.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh chỉ hỗ trợ định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ]);

        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        // 👈 3. CHÈN LOG KHI CẬP NHẬT BÀI VIẾT THÀNH CÔNG
        Log::info('Bài viết đã được cập nhật!', ['post_id' => $post->id]);

        return redirect()->route('posts.show', $post)->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài viết của người khác!');
        }

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $postId = $post->id;
        $post->delete();

        // 👈 4. CHÈN LOG KHI XÓA BÀI VIẾT
        Log::info('Bài viết đã bị xóa khỏi hệ thống.', ['post_id' => $postId]);

        return redirect()->route('posts.index')->with('success', 'Đã xóa bài viết thành công!');
    }
}
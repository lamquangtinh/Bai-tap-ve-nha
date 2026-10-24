<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePost($request);

        $data['user_id'] = $request->user()->id;
        $data['slug'] = $this->uniqueSlug(
            $data['slug'] ?: $data['title']
        );

        // Lưu ảnh bìa vào storage/app/public/posts
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('posts', 'public');
        } else {
            unset($data['image']);
        }

        Post::create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Đã tạo bài viết thành công.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validatePost($request, $post);

        $data['slug'] = $this->uniqueSlug(
            $data['slug'] ?: $data['title'],
            $post->id
        );

        // Chỉ thay ảnh nếu người dùng chọn ảnh mới
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')
                ->store('posts', 'public');
        } else {
            unset($data['image']);
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Đã cập nhật bài viết.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Đã xóa bài viết.');
    }

    private function validatePost(
        Request $request,
        ?Post $post = null
    ): array {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post?->id),
            ],

            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'status' => [
                'required',
                Rule::in(['draft', 'published']),
            ],
        ]);
    }

    private function uniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($value);

        if ($base === '') {
            $base = 'bai-viet';
        }

        $slug = $base;
        $counter = 1;

        while (
            Post::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
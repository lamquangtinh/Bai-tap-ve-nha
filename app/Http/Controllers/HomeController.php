<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPost = Post::published()
            ->latest()
            ->first();

        $posts = Post::published()
            ->with('user')
            ->latest()
            ->paginate(9);

        return view('home', compact('featuredPost', 'posts'));
    }

    public function show(string $slug)
    {
        $post = Post::published()
            ->with([
                'user',
                'comments' => function ($query) {
                    $query->latest();
                },
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}

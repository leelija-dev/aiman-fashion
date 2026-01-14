<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    public function posts(Request $request)
    {
        $query = Post::query()->with(['categories', 'tags', 'author']);

        // Only published by default
        if ($request->boolean('include_unpublished') !== true) {
            $query->published();
        }

        if ($q = $request->string('q')) {
            $query->search($q);
        }

        if ($category = $request->string('category')) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($tag = $request->string('tag')) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('slug', $tag);
            });
        }

        $perPage = min((int) $request->input('per_page', 10), 100);
        $posts = $query->latest('published_at')->paginate($perPage)->withQueryString();

        return response()->json($posts);
    }

    public function post(string $slug)
    {
        $post = Post::with(['categories', 'tags', 'author'])->where('slug', $slug)->firstOrFail();
        return response()->json($post);
    }

    public function categories()
    {
        return response()->json(Category::orderBy('name')->get());
    }

    public function tags()
    {
        return response()->json(Tag::orderBy('name')->get());
    }
}

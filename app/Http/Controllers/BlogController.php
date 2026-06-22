<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class BlogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:blog.view', only: ['index', 'show']),
            new Middleware('permission:blog.create', only: ['create', 'store']),
            new Middleware('permission:blog.edit', only: ['edit', 'update']),
            new Middleware('permission:blog.delete', only: ['destroy']),
        ];
    }

    // ====================== PUBLIC ROUTES ======================

    public function index()
    {
        $posts = BlogPost::published()
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.blog.show', compact('post'));
    }

    // ====================== ADMIN ROUTES ======================

    public function adminIndex()
    {
        $posts = BlogPost::with(['category', 'tags'])
            ->latest()
            ->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['featured_image', 'tags']);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = BlogPost::create($data);

        // Sync Tags
        if ($request->filled('tags')) {
            $post->syncTags($request->tags);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['featured_image', 'tags']);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post->update($data);

        // Sync Tags
        if ($request->filled('tags')) {
            $post->syncTags($request->tags);
        } elseif ($request->has('tags')) {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
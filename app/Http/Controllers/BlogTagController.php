<?php

namespace App\Http\Controllers;

use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class BlogTagController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:blog-tag.view', only: ['index', 'show']),
            new Middleware('permission:blog-tag.create', only: ['create', 'store']),
            new Middleware('permission:blog-tag.edit', only: ['edit', 'update']),
            new Middleware('permission:blog-tag.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $tags = BlogTag::withCount('posts')->latest()->paginate(15);
        return view('admin.blog.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags',
        ]);

        BlogTag::create($request->only('name'));

        return redirect()->route('admin.blog.tags.index')
            ->with('success', 'Tag created successfully!');
    }

    public function edit(BlogTag $tag)
    {
        return view('admin.blog.tags.edit', compact('tag'));
    }

    public function update(Request $request, BlogTag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name,' . $tag->id,
        ]);

        $tag->update($request->only('name'));

        return redirect()->route('admin.blog.tags.index')
            ->with('success', 'Tag updated successfully!');
    }

    public function destroy(BlogTag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag deleted successfully!');
    }
}
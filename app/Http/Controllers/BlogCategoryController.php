<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class BlogCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:blog-category.view', only: ['index', 'show']),
            new Middleware('permission:blog-category.create', only: ['create', 'store']),
            new Middleware('permission:blog-category.edit', only: ['edit', 'update']),
            new Middleware('permission:blog-category.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = BlogCategory::withCount('posts')->latest()->paginate(10);
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
            'description' => 'nullable|string',
        ]);

        BlogCategory::create($request->only(['name', 'description']));

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit(BlogCategory $category)
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, BlogCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(BlogCategory $category)
    {
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete category with posts!');
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }
}
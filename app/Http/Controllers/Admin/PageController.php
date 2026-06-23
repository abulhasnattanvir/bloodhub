<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class PageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:page.view', only: ['index', 'show']),
            new Middleware('permission:page.create', only: ['create', 'store']),
            new Middleware('permission:page.edit', only: ['edit', 'update']),
            new Middleware('permission:page.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pages,slug',
            'content' => 'required'
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'content' => 'required'
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('success', 'Page deleted successfully');
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('frontend.page', compact('page'));
    }
}
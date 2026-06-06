<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Galleries::latest()->paginate(12);
        $categories = Galleries::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:1120',
            'category'    => 'nullable|string|max:100',
            'event_date'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Galleries::create([
            'title'       => $request->title,
            'image'       => $imagePath,
            'category'    => $request->category,
            'event_date'  => $request->event_date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image added successfully!');
    }

    public function edit(Galleries $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Galleries $gallery)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1120',
            'category'    => 'nullable|string|max:100',
            'event_date'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'category', 'event_date', 'description']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery updated successfully!');
    }

    public function destroy(Galleries $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    /**
     * New Method: Get Galleries by Category (for Frontend)
     */
    public function getByCategory($category = null)
    {
        if ($category && $category !== 'all') {
            $galleries = Galleries::where('category', $category)
                ->latest()
                ->get();
        } else {
            $galleries = Galleries::latest()->get();
        }

        return response()->json($galleries);
    }
}
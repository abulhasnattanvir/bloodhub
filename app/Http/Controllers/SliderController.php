<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class SliderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:slider.view', only: ['index', 'show']),
            new Middleware('permission:slider.create', only: ['create', 'store']),
            new Middleware('permission:slider.edit', only: ['edit', 'update']),
            new Middleware('permission:slider.delete', only: ['destroy']),
        ];
    }

    // LIST
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.sliders.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'highlight_text' => $request->highlight_text,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,

            'image' => $path,
            'order' => $request->order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider Created');
    }

    // EDIT FORM
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    // UPDATE
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'order' => 'nullable|integer',
        ]);

        $image = $slider->image;

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $image = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'highlight_text' => $request->highlight_text,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $image,
            'order' => $request->order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider Updated');
    }

    // DELETE
    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', 'Slider Deleted');
    }
}
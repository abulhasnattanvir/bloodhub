<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GreenInitiative;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class GreenInitiativeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:green.view', only: ['index', 'show']),
            new Middleware('permission:green.create', only: ['create', 'store']),
            new Middleware('permission:green.edit', only: ['edit', 'update']),
            new Middleware('permission:green.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $greenInitiatives = GreenInitiative::latest()->paginate(10);
        return view('admin.green.index', compact('greenInitiatives'));
    }

    public function create()
    {
        return view('admin.green.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'date', 'location']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('green_initiatives', 'public');
        }

        GreenInitiative::create($data);

        return redirect()->route('admin.green.index')
            ->with('success', 'সবুজ উদ্যোগ সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(GreenInitiative $greenInitiative)
    {
        return view('admin.green.edit', compact('greenInitiative'));
    }

    public function update(Request $request, GreenInitiative $greenInitiative)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date'        => 'nullable|date',
            'location'    => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'date', 'location']);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($greenInitiative->image) {
                Storage::disk('public')->delete($greenInitiative->image);
            }

            $data['image'] = $request->file('image')->store('green_initiatives', 'public');
        }

        $greenInitiative->update($data);

        return redirect()->route('admin.green.index')
            ->with('success', 'সবুজ উদ্যোগ সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(GreenInitiative $greenInitiative)
    {
        if ($greenInitiative->image) {
            Storage::disk('public')->delete($greenInitiative->image);
        }
        $greenInitiative->delete();

        return redirect()->route('admin.green.index')
            ->with('success', 'সবুজ উদ্যোগ মুছে ফেলা হয়েছে।');
    }
}
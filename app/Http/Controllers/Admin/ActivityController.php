<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ActivityController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:activity.view', only: ['index', 'show']),
            new Middleware('permission:activity.create', only: ['create', 'store']),
            new Middleware('permission:activity.edit', only: ['edit', 'update']),
            new Middleware('permission:activity.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $activities = Activity::latest()->paginate(10);

        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        Activity::create([
            'icon' => $validated['icon'],
            'text' => $validated['text'],
            'slug' => Str::slug($validated['text']),
        ]);

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'কার্যক্রম সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $activity->update([
            'icon' => $validated['icon'],
            'text' => $validated['text'],
            'slug' => Str::slug($validated['text']),
        ]);

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'কার্যক্রম সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'কার্যক্রম সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
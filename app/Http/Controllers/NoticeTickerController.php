<?php

namespace App\Http\Controllers;

use App\Models\NoticeTicker;
use Illuminate\Http\Request;

class NoticeTickerController extends Controller
{
    public function index()
    {
        $tickers = NoticeTicker::latest()->paginate(20);

        return view('admin.noticeticker.index', compact('tickers'));
    }

    public function create()
    {
        return view('admin.noticeticker.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $validated['is_active'] = $request->has('is_active');

        NoticeTicker::create($validated);

        return redirect()
            ->route('admin.notice-ticker.index')
            ->with('success', 'Ticker created.');
    }

    public function edit(NoticeTicker $noticeTicker)
    {
        return view('admin.noticeticker.edit', compact('noticeTicker'));
    }

    public function update(Request $request, NoticeTicker $noticeTicker)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $noticeTicker->update($validated);

        return redirect()
            ->route('admin.notice-ticker.index')
            ->with('success', 'Ticker updated.');
    }

    public function destroy(NoticeTicker $noticeTicker)
    {
        $noticeTicker->delete();

        return back();
    }
}
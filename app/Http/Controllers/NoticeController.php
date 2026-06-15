<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notices::active()
            ->latestFirst()
            ->paginate(15);

        return view('frontend.notices', compact('notices'));
    }

    public function adminIndex()
    {
        $notices = Notices::latestFirst()->paginate(20);   // paginate ভালো
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'pdf_file'     => 'required|file|mimes:pdf|max:10240',
            'description'  => 'nullable|string',
            'notice_date'  => 'required|date',
        ]);

        $file = $request->file('pdf_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/notices', $filename);

        Notices::create([
            'title'        => $request->title,
            'pdf_file'     => $filename,
            'description'  => $request->description,
            'notice_date'  => $request->notice_date,
            'is_active'    => $request->has('is_active'),   // ← যোগ করা হয়েছে
        ]);

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ সফলভাবে আপলোড হয়েছে।');
    }

    public function edit(Notices $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notices $notice)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'pdf_file'     => 'nullable|file|mimes:pdf|max:10240',
            'description'  => 'nullable|string',
            'notice_date'  => 'required|date',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'notice_date' => $request->notice_date,
            'is_active'   => $request->has('is_active'),
        ];

        if ($request->hasFile('pdf_file')) {
            Storage::delete('public/notices/' . $notice->pdf_file);

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/notices', $filename);
            $data['pdf_file'] = $filename;
        }

        $notice->update($data);

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ সফলভাবে আপডেট হয়েছে।');
    }

    public function destroy(Notices $notice)
    {
        Storage::delete('public/notices/' . $notice->pdf_file);
        $notice->delete();

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ ডিলিট করা হয়েছে।');
    }

    public function download($id)
    {
        $notice = Notices::findOrFail($id);
        $filePath = 'public/notices/' . $notice->pdf_file;

        if (!Storage::exists($filePath)) {
            abort(404, 'ফাইল পাওয়া যায়নি');
        }

        return Storage::download($filePath, $notice->title . '.pdf');
    }
}
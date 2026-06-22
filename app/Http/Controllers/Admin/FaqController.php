<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class FaqController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:faq.view', only: ['index', 'show']),
            new Middleware('permission:faq.create', only: ['create', 'store']),
            new Middleware('permission:faq.edit', only: ['edit', 'update']),
            new Middleware('permission:faq.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        Faq::create($request->all());
        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ Added Successfully');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            
        ]);

        $faq->update($request->all());

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ Updated Successfully');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', 'FAQ Deleted Successfully');
    }
}
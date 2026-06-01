<?php

namespace App\Http\Controllers\Admin;

use App\Models\Council;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouncilController extends Controller
{
    // ADMIN LIST
    public function index()
    {
        $councils = Council::latest()->paginate(10);
        return view('admin.council.index', compact('councils'));
    }

    // CREATE
    public function create()
    {
        return view('admin.council.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;

        if ($request->photo) {
            $file = $request->file('photo');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/council'), $name);
            $photoPath = 'uploads/council/' . $name;
        }

        Council::create([
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
            'email' => $request->email,
            'bio' => $request->bio,
            'photo' => $photoPath,

            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,

            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.council.index')
            ->with('success', 'Council member added');
    }

    // EDIT
    public function edit($id)
    {
        $council = Council::findOrFail($id);
        return view('admin.council.edit', compact('council'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $council = Council::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'position' => 'required',
        ]);

        if ($request->photo) {

            if ($council->photo && file_exists(public_path($council->photo))) {
                unlink(public_path($council->photo));
            }

            $file = $request->file('photo');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/council'), $name);

            $council->photo = 'uploads/council/' . $name;
        }

        $council->update([
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
            'email' => $request->email,
            'bio' => $request->bio,

            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,

            'status' => $request->status ?? 1,
            'photo' => $council->photo,
        ]);

        return back()->with('success', 'Updated successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $council = Council::findOrFail($id);

        if ($council->photo && file_exists(public_path($council->photo))) {
            unlink(public_path($council->photo));
        }

        $council->delete();

        return back()->with('success', 'Deleted successfully');
    }

    // FRONTEND
    public function frontend()
    {
        $councils = Council::where('status', 1)->get();
        return view('frontend.council.index', compact('councils'));
    }
}
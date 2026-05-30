<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    // FRONTEND FORM
    public function create()
    {
        return view('frontend.members');
    }

    // STORE MEMBER
    public function store(Request $request)
    {
        // 🛡️ HONEYPOT CHECK
        if ($request->filled('website')) {
            return back()->with('error', 'Spam detected!');
        }

        // ⏱️ TIME CHECK (min 3 sec)
        if (time() - $request->form_time < 3) {
            return back()->with('error', 'Too fast submission detected!');
        }

        // VALIDATION
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:members,phone|max:11|min:11',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // PHOTO UPLOAD
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/members'), $filename);
            $photoPath = 'uploads/members/' . $filename;
        }

        // SAVE MEMBER
        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'blood_group' => $request->blood_group,
            'city' => $request->city,
            'address' => $request->address,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    // ADMIN LIST
    public function index(Request $request)
    {
        $query = Member::query();

        // 🔍 KEYWORD SEARCH (name, phone, email)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // 🩸 BLOOD FILTER
        if ($request->blood_group) {
            $query->where('blood_group', $request->blood_group);
        }

        // 📍 CITY FILTER
        if ($request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // 📊 STATUS FILTER (optional but useful)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $members = $query->latest()->paginate(10);

        return view('admin.member.index', compact('members'));
    }

    // APPROVE
    public function approve($id)
    {
        Member::findOrFail($id)->update(['status' => 'approved']);
        return back();
    }

    // REJECT
    public function reject($id)
    {
        Member::findOrFail($id)->update(['status' => 'rejected']);
        return back();
    }

    // DELETE
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // delete photo from storage
        if ($member->photo && File::exists(public_path($member->photo))) {
            File::delete(public_path($member->photo));
        }

        $member->delete();

        return back()->with('success', 'Member deleted successfully');
    }

    //EDIT
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    //UPDATE
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // OLD PHOTO DELETE + NEW UPLOAD
        if ($request->hasFile('photo')) {

            if ($member->photo && File::exists(public_path($member->photo))) {
                File::delete(public_path($member->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/members'), $filename);

            $member->photo = 'uploads/members/' . $filename;
        }

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'blood_group' => $request->blood_group,
            'city' => $request->city,
            'address' => $request->address,
            'status' => $request->status,
            'photo' => $member->photo,
        ]);

        return redirect()->route('admin.members')->with('success', 'Member updated successfully');
    }
}
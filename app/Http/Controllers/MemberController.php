<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Donor;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class MemberController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:member.view', only: ['index', 'show']),
            new Middleware('permission:member.create', only: ['create', 'store']),
            new Middleware('permission:member.edit', only: ['edit', 'update']),
            new Middleware('permission:member.delete', only: ['destroy']),
        ];
    }

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
            'faname' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'phone' => 'required|unique:members,phone|max:11|min:11',
            'gender' => 'required|in:male,female,other',
            'profession' => 'nullable|string|max:100',
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
            'faname' => $request->faname,
            'age' => $request->age,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'email' => $request->email,
            'blood_group' => $request->blood_group,
            'city' => $request->city,
            'address' => $request->address,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }


    public function frontendIndex(Request $request)
    {
        $query = Member::where('status', 'approved');

        // 🔍 optional search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%')
                    ->orWhere('blood_group', 'like', '%' . $request->search . '%');
            });
        }

        // 🩸 blood filter
        if ($request->blood_group) {
            $query->where('blood_group', $request->blood_group);
        }

        // 📍 city filter
        if ($request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $members = $query->latest()->paginate(9);

        return view('frontend.members.index', compact('members'));
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
        return view('admin.member.edit', compact('member'));
    }

    //UPDATE
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'faname' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'gender' => 'required|in:male,female,other',
            'profession' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fee_applicable' => 'nullable|boolean',
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
            'faname' => $request->faname,
            'age' => $request->age,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'blood_group' => $request->blood_group,
            'city' => $request->city,
            'address' => $request->address,
            'status' => $request->status,
            'photo' => $member->photo,
            'fee_applicable' => $request->fee_applicable ? 1 : 0,
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully');
    }

    public function convertToDonor($id)
    {
        $member = Member::findOrFail($id);

        // ইতিমধ্যে donor আছে কিনা চেক
        if ($member->donor()->exists() || $member->is_donor) {
            return back()->with('error', 'This member is already converted to donor.');
        }

        // Blood Group খুঁজে বের করা
        $bloodGroup = BloodGroup::where('name', $member->blood_group)->first();

        // Donor তৈরি করা
        $donor = Donor::create([
            'member_id'           => $member->id,
            'full_name'           => $member->name,
            'profile_photo'       => $member->photo,
            'blood_group_id'      => $bloodGroup?->id,
            'phone_number'        => $member->phone,
            'gender'              => $member->gender,
            'address'             => $member->address,
            'email'               => $member->email,
            'availability_status' => true,
            'last_donation_date'  => null,
            'notes'               => 'Converted from Member on ' . now()->format('Y-m-d'),
        ]);

        // Member আপডেট (is_donor ফ্ল্যাগ)
        $member->update(['is_donor' => true]);

        return back()->with('success', 'Member successfully converted to Donor!');
    }
}
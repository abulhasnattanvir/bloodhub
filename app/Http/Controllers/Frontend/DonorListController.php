<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DonorListController extends Controller
{
    /**
     * Show a listing of donors.
     */
    public function index(Request $request)
    {
        $query = Donor::with('bloodGroup');

        // Search by name, phone, or email (like admin system)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Search by blood group
        if ($request->filled('blood_group')) {
            $query->where('blood_group_id', $request->input('blood_group'));
        }

        // Search by availability status
        if ($request->filled('availability_status')) {
            $query->where('availability_status', $request->input('availability_status'));
        }

        // Get donors
        $donors = $query->latest()->paginate(10)->withQueryString();

        // Get blood groups for filter
        $bloodGroups = BloodGroup::all();

        return view('frontend.donors.index', compact('donors', 'bloodGroups', 'request'));
    }

    /**
     * Show the form for creating a new donor.
     */
    public function create()
    {
        $bloodGroups = BloodGroup::all();
        return view('frontend.donors.create', compact('bloodGroups'));
    }

    /**
     * Store a newly created donor in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blood_group_id' => 'required|exists:blood_groups,id',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'last_donation_date' => 'nullable|date',
            'availability_status' => 'required|in:available,not_available',
            'email' => 'nullable|email|max:255|unique:donors',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $donor = new Donor();
        $donor->full_name = $request->input('full_name');
        $donor->blood_group_id = $request->input('blood_group_id');
        $donor->phone_number = $request->input('phone_number');
        $donor->gender = $request->input('gender');
        $donor->address = $request->input('address');
        $donor->last_donation_date = $request->input('last_donation_date');
        $donor->availability_status = $request->input('availability_status');
        $donor->email = $request->input('email');
        $donor->notes = $request->input('notes');

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('donor_photos', 'public');
            $donor->profile_photo = $path;
        }

        $donor->save();

        return redirect()->route('donors.list')
            ->with('success', 'Donor created successfully.');
    }

    /**
     * Show the form for editing the specified donor.
     */
    public function edit(Donor $donor)
    {
        $bloodGroups = BloodGroup::all();
        return view('frontend.donors.edit', compact('donor', 'bloodGroups'));
    }

    /**
     * Update the specified donor in storage.
     */
    public function update(Request $request, Donor $donor)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blood_group_id' => 'required|exists:blood_groups,id',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'last_donation_date' => 'nullable|date',
            'availability_status' => 'required|in:available,not_available',
            'email' => 'nullable|email|max:255|unique:donors,email,'.$donor->id,
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $donor->full_name = $request->input('full_name');
        $donor->blood_group_id = $request->input('blood_group_id');
        $donor->phone_number = $request->input('phone_number');
        $donor->gender = $request->input('gender');
        $donor->address = $request->input('address');
        $donor->last_donation_date = $request->input('last_donation_date');
        $donor->availability_status = $request->input('availability_status');
        $donor->email = $request->input('email');
        $donor->notes = $request->input('notes');

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($donor->profile_photo) {
                Storage::disk('public')->delete($donor->profile_photo);
            }
            $path = $request->file('profile_photo')->store('donor_photos', 'public');
            $donor->profile_photo = $path;
        }

        $donor->save();

        return redirect()->route('donors.list')
            ->with('success', 'Donor updated successfully.');
    }

    /**
     * Remove the specified donor from storage.
     */
    public function destroy(Donor $donor)
    {
        // Delete profile photo if exists
        if ($donor->profile_photo) {
            Storage::disk('public')->delete($donor->profile_photo);
        }

        $donor->delete();

        return redirect()->route('donors.list')
            ->with('success', 'Donor deleted successfully.');
    }

    /**
     * Display the specified donor as JSON for API.
     */
    public function apiShow(Donor $donor)
    {
        return response()->json([
            'id' => $donor->id,
            'full_name' => $donor->full_name,
            'phone_number' => $donor->phone_number,
            'gender' => $donor->gender,
            'email' => $donor->email,
            'address' => $donor->address,
            'last_donation_date' => $donor->last_donation_date ? $donor->last_donation_date->toIso8601String() : null,
            'availability_status' => $donor->availability_status,
            'profile_photo' => $donor->profile_photo ? Storage::url($donor->profile_photo) : null,
            'bloodGroup' => $donor->bloodGroup ? [
                'id' => $donor->bloodGroup->id,
                'name' => $donor->bloodGroup->name
            ] : null,
            'notes' => $donor->notes
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Models\Donor;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Donor::with('bloodGroup');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by blood group
        if ($request->filled('blood_group')) {
            $query->where('blood_group_id', $request->input('blood_group'));
        }

        // Filter by availability
        if ($request->filled('availability_status')) {
            $query->where('availability_status', $request->input('availability_status'));
        }

        $donors = $query->latest()->paginate(10)->withQueryString();

        $bloodGroups = BloodGroup::all();

        return view('admin.donors.index', compact('donors', 'bloodGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bloodGroups = BloodGroup::all();
        return view('admin.donors.create', compact('bloodGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonorRequest $request)
    {
        $data = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('donor_photos', 'public');
            $data['profile_photo'] = $path;
        }

        Donor::create($data);

        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor)
    {
        return view('admin.donors.show', compact('donor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
        $bloodGroups = BloodGroup::all();
        return view('admin.donors.edit', compact('donor', 'bloodGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonorRequest $request, Donor $donor)
    {
        $data = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($donor->profile_photo) {
                Storage::disk('public')->delete($donor->profile_photo);
            }
            $path = $request->file('profile_photo')->store('donor_photos', 'public');
            $data['profile_photo'] = $path;
        }

        $donor->update($data);

        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donor $donor)
    {
        // Delete profile photo if exists
        if ($donor->profile_photo) {
            Storage::disk('public')->delete($donor->profile_photo);
        }
        $donor->forceDelete();
        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor deleted successfully.');
    }

    
}
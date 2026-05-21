<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;

class SearchController extends Controller
{
    /**
     * Show the search form and handle search requests.
     */
    public function index(Request $request)
    {
        $query = Donor::with('bloodGroup');

        // Search by name
        if ($request->filled('name')) {
            $query->where('full_name', 'like', "%{$request->input('name')}%");
        }

        // Search by blood group
        if ($request->filled('blood_group')) {
            $query->where('blood_group_id', $request->input('blood_group'));
        }

        // Search by phone number
        if ($request->filled('phone')) {
            $query->where('phone_number', 'like', "%{$request->input('phone')}%");
        }

        // Search by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // Get donors
        $donors = $query->latest()->paginate(10)->withQueryString();

        // Get blood groups for filter
        $bloodGroups = BloodGroup::all();

        return view('frontend.search', compact('donors', 'bloodGroups', 'request'));
    }
}

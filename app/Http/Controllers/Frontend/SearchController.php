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

        // Get donors
        $donors = $query->latest()->paginate(10)->withQueryString();

        // Get blood groups for filter
        $bloodGroups = BloodGroup::all();

        return view('frontend.search', compact('donors', 'bloodGroups', 'request'));
    }
}

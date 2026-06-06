<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;
use App\Models\Faq;

class BloodController extends Controller
{
    public function index()
    {
        $totalDonors = Donor::count();
        $availableDonors = Donor::where('availability_status', 'available')->count();
        $recentDonors = Donor::with('bloodGroup')->latest()->take(4)->get();

        // FIXED LINE
        $bloodGroups = BloodGroup::withCount('donors')->get();
        $faqs = Faq::latest()->get();

        return view('frontend.blood', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroups',
            'faqs'
        ));
    }
}
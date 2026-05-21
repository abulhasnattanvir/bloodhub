<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index()
    {
        // For the homepage, we can show some statistics or featured donors
        $totalDonors = Donor::count();
        $availableDonors = Donor::where('availability_status', 'available')->count();
        $recentDonors = Donor::with('bloodGroup')->latest()->take(4)->get();
        $bloodGroups = BloodGroup::all();

        return view('frontend.home', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroups'
        ));
    }
}

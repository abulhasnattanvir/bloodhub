<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;
use App\Models\Slider;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index()
    {
        // Statistics
        $totalDonors = Donor::count();
        $availableDonors = Donor::where('availability_status', 'available')->count();
        $recentDonors = Donor::with('bloodGroup')->latest()->take(4)->get();
        $bloodGroups = BloodGroup::all();

        // SLIDERS (NEW ADD)
        $sliders = Slider::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
// dd($sliders);
        return view('frontend.home', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroups',
            'sliders'   // ✅ IMPORTANT
        ));
    }
}
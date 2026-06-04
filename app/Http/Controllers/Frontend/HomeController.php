<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodGroup;
use App\Models\Slider;
use App\Models\Goal;


class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index()
    {
        $totalDonors = Donor::count();
        $availableDonors = Donor::where('availability_status', 'available')->count();
        $recentDonors = Donor::with('bloodGroup')->latest()->take(4)->get();
        $goals = Goal::all();
        // FIXED LINE
        $bloodGroups = BloodGroup::withCount('donors')->get();

        $sliders = Slider::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $activities = Activity::latest()->get();

        return view('frontend.home', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroups',
            'sliders',
            'goals',
            'activities'
        ));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalDonors = Donor::count();
        $availableDonors = Donor::where('availability_status', 'available')->count();
        $recentDonors = Donor::with('bloodGroup')->latest()->take(5)->get();

        // Blood group statistics
        $bloodGroupStats = Donor::selectRaw('blood_groups.name, count(donors.id) as count')
            ->join('blood_groups', 'donors.blood_group_id', '=', 'blood_groups.id')
            ->groupBy('blood_groups.name')
            ->pluck('count', 'blood_groups.name')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroupStats'
        ));
    }
}

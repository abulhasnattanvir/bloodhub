<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\Member;
use App\Models\Payment;
use App\Models\MemberSubscription;
use App\Models\Council;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Today's stats
        $today = Carbon::today();
        $todayDonors = Donor::whereDate('created_at', $today)->count();
        $todayDonations = Donor::whereNotNull('last_donation_date')
            ->whereDate('last_donation_date', $today)
            ->count();

        // Blood group statistics
        $bloodGroupStats = Donor::selectRaw('blood_groups.name, count(donors.id) as count')
            ->join('blood_groups', 'donors.blood_group_id', '=', 'blood_groups.id')
            ->groupBy('blood_groups.name')
            ->pluck('count', 'blood_groups.name')
            ->toArray();

        // ==================== NEW STATS ====================
        $totalMembers         = Member::all()->count();
        $totalCouncilMembers  = Council::all()->count();
        // dd($totalDonors);

        $totalDue = MemberSubscription::where('status', 'unpaid')
            ->sum('expected_amount');

        $paidThisMonth = Payment::whereMonth('paid_at',now()->month)->sum('amount');

        $unpaidMembers = MemberSubscription::where('status', 'unpaid')
            ->whereHas('member', function ($q) {
                $q->where('fee_applicable', 1);
            })
            ->distinct('member_id')
            ->count();

        // Total Money Donation (assuming 'amount' column exists in donations table)
        $totalDonationsAmount = Donation::sum('amount');

        return view('admin.dashboard', compact(
            'totalDonors',
            'availableDonors',
            'recentDonors',
            'bloodGroupStats',
            'todayDonors',
            'todayDonations',
            'totalMembers',
            'totalCouncilMembers',
            'totalDonationsAmount',
            'totalDue',
            'paidThisMonth',
            'unpaidMembers'
        ));
    }
}
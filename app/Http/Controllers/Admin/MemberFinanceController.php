<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\FeeStructure;
use App\Models\MemberSubscription;
use App\Models\Payment;
use Illuminate\Http\Request;

class MemberFinanceController extends Controller
{
    public function index()
    {
        $members = Member::with('payments')->get();

        foreach ($members as $member) {

            // 💰 Total Paid Amount
            $member->total_paid = $member->payments->sum('amount');

            // 📅 First payment date (start date)
            $member->start_date = $member->payments->min('paid_at');

            // 📅 Until now (optional display)
            $member->last_payment = $member->payments->max('paid_at');
        }

        return view('admin.finance.index', compact('members'));
    }

    public function show(Member $member)
    {
        $subscriptions = MemberSubscription::where('member_id', $member->id)
            ->latest()
            ->get();

        $totalDue = $subscriptions
            ->where('status', 'unpaid')
            ->sum('expected_amount');

        return view(
            'admin.finance.show',
            compact(
                'member',
                'subscriptions',
                'totalDue'
            )
        );
    }
}
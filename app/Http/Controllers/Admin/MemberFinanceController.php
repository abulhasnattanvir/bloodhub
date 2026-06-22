<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\FeeStructure;
use App\Models\MemberSubscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class MemberFinanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:finance.view', only: ['index', 'show']),
            new Middleware('permission:finance.create', only: ['create', 'store']),
            new Middleware('permission:finance.edit', only: ['edit', 'update']),
            new Middleware('permission:finance.delete', only: ['destroy']),
        ];
    }

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
            ->paginate(10); // ✅ pagination added

        $totalDue = MemberSubscription::where('member_id', $member->id)
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
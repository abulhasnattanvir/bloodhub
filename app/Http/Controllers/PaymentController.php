<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberSubscription;
use App\Models\Payment;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $member = Member::findOrFail($request->member_id);

        if (!$member->fee_applicable) {
            return back()->with('error', 'This member is fee-free');
        }

        $fee = FeeStructure::where('profession', $member->profession)
            ->where('status', 1)
            ->first();

        if (!$fee) {
            return back()->with('error', 'No fee structure found.');
        }

        $monthlyFee = $fee->monthly_fee;

        if ($request->amount < $monthlyFee) {
            return back()->with('error', "Minimum payment is {$monthlyFee}");
        }

        if ($request->amount % $monthlyFee !== 0) {
            return back()->with('error', "Amount must be multiple of {$monthlyFee}");
        }

        $monthsToPay = (int) ($request->amount / $monthlyFee);

        /*
        |--------------------------------------------------------------------------
        | AUTO GENERATE MISSING MONTHS (IMPORTANT FIX)
        |--------------------------------------------------------------------------
        */

        $existing = MemberSubscription::where('member_id', $member->id)
            ->orderBy('month')
            ->get();

        if ($existing->count() < $monthsToPay) {

            $lastMonth = MemberSubscription::where('member_id', $member->id)
                ->max('month');

            $start = $lastMonth
                ? Carbon::parse($lastMonth)->addMonth()
                : Carbon::now()->startOfMonth();

            $missing = $monthsToPay - $existing->count();

            for ($i = 0; $i < $missing; $i++) {
                MemberSubscription::create([
                    'member_id' => $member->id,
                    'month' => $start->copy()->addMonths($i)->format('Y-m'),
                    'expected_amount' => $monthlyFee,
                    'status' => 'unpaid',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | GET UNPAID MONTHS AGAIN (FINAL)
        |--------------------------------------------------------------------------
        */

        $subscriptions = MemberSubscription::where('member_id', $member->id)
            ->where('status', 'unpaid')
            ->orderBy('month')
            ->take($monthsToPay)
            ->get();

        if ($subscriptions->isEmpty()) {
            return back()->with('error', 'No unpaid months found');
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE PAYMENT
        |--------------------------------------------------------------------------
        */

        Payment::create([
            'member_id' => $member->id,
            'amount' => $request->amount,
            'months_covered' => $monthsToPay,
            'method' => $request->method,
            'note' => $request->note,
            'paid_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | MARK AS PAID
        |--------------------------------------------------------------------------
        */

        foreach ($subscriptions as $sub) {
            $sub->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return back()->with('success', "{$monthsToPay} month(s) paid successfully");
    }
}
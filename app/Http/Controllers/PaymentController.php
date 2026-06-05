<?php

namespace App\Http\Controllers;

use App\Models\MemberSubscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PaymentController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'subscription_id' => 'required|exists:member_subscriptions,id',
    //         'amount' => 'required|numeric|min:1',
    //         'method' => 'nullable|string'
    //     ]);

    //     $subscription = MemberSubscription::findOrFail(
    //         $request->subscription_id
    //     );

    //     Payment::create([
    //         'member_id' => $subscription->member_id,
    //         'amount' => $request->amount,
    //         'month' => $subscription->month,
    //         'method' => $request->method,
    //         'paid_at' => now(),
    //     ]);

    //     $subscription->update([
    //         'status' => 'paid',
    //         'paid_at' => now(),
    //     ]);

    //     return redirect()
    //         ->back()
    //         ->with('success', 'Payment received successfully.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:1',
            'months_covered' => 'required|integer|min:1',
            'method' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $memberId = $request->member_id;
        $monthsToPay = $request->months_covered;

        $subscriptions = MemberSubscription::where('member_id', $memberId)
            ->where('status', 'unpaid')
            ->orderBy('month', 'asc')
            ->take($monthsToPay)
            ->get();

        // 1️⃣ Save Payment
        Payment::create([
            'member_id' => $memberId,
            'amount' => $request->amount,
            'months_covered' => $monthsToPay,
            'month' => now()->format('Y-m'),
            'method' => $request->method,
            'note' => $request->note,
            'paid_at' => now(),
        ]);

        // 🔥 Mark those exact months as paid
        foreach ($subscriptions as $subscription) {
            $subscription->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Payment successful (Advance supported)');
    }
}
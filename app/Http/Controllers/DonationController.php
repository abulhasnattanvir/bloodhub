<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // FRONTEND FORM
    public function create()
    {
        return view('frontend.donation.index');
    }

    // STORE DONATION
    public function store(Request $request)
    {
        // 🛡️ spam protection
        if ($request->filled('website')) {
            return back()->with('error', 'Spam detected');
        }

        if (time() - $request->form_time < 5) {
            return back()->with('error', 'Too fast submission');
        }

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:bkash,nagad,bank',
            'transaction_id' => 'required|unique:donations,transaction_id',
        ]);

        Donation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'method' => $request->method,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Donation submitted for verification');
    }

    // ADMIN LIST
    public function index(Request $request)
    {
        $query = Donation::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $donations = $query->latest()->paginate(10);

        return view('admin.donation.index', compact('donations'));
    }

    // APPROVE
    public function approve($id)
    {
        Donation::findOrFail($id)->update(['status' => 'approved']);
        return back();
    }

    // REJECT
    public function reject($id)
    {
        Donation::findOrFail($id)->update(['status' => 'rejected']);
        return back();
    }

    // DELETE
    public function destroy($id)
    {
        Donation::findOrFail($id)->delete();
        return back();
    }

    public function contributors()
    {
        $donations = Donation::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('name');

        $donors = $donations->map(function ($items, $name) {

            return (object) [
                'name' => $name,
                'total_amount' => $items->sum('amount'),
                'total_donations' => $items->count(),
                'last_donation' => $items->first()->created_at,
            ];
        })->sortByDesc('total_amount')->values();

        // manual pagination (collection paginate)
        $page = request()->get('page', 1);
        $perPage = 12;

        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $donors->forPage($page, $perPage),
            $donors->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('frontend.donation.donationContributors', [
            'donors' => $paginated
        ]);
    }
}
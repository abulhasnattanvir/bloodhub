<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeStructure;

class FeeStructureController extends Controller
{
    public function index()
    {
        $fees = FeeStructure::latest()->paginate(20);

        return view('admin.fees.index', compact('fees'));
    }

    public function create()
    {
        return view('admin.fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'profession' => 'required|unique:fee_structures',
            'monthly_fee' => 'required|numeric|min:0'
        ]);

        FeeStructure::create($request->all());

        return redirect()
            ->route('admin.fees.index')
            ->with('success', 'Fee structure created');
    }

    public function edit(FeeStructure $fee)
    {
        return view('admin.fees.edit', compact('fee'));
    }

    public function update(Request $request, FeeStructure $fee)
    {
        $request->validate([
            'profession' => 'required',
            'monthly_fee' => 'required|numeric|min:0'
        ]);

        $fee->update($request->all());

        return redirect()
            ->route('admin.fees.index')
            ->with('success', 'Fee updated');
    }

    public function destroy(FeeStructure $fee)
    {
        $fee->delete();

        return back()->with('success', 'Deleted');
    }
}
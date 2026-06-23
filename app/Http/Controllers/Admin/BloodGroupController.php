<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBloodGroupRequest;
use App\Http\Requests\UpdateBloodGroupRequest;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class BloodGroupController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:bloodgroup.view', only: ['index', 'show']),
            new Middleware('permission:bloodgroup.create', only: ['create', 'store']),
            new Middleware('permission:bloodgroup.edit', only: ['edit', 'update']),
            new Middleware('permission:bloodgroup.delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BloodGroup::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        $bloodGroups = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.blood-groups.index', compact('bloodGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blood-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBloodGroupRequest $request)
    {
        BloodGroup::create($request->validated());

        return redirect()->route('admin.blood-groups.index')
            ->with('success', 'Blood group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodGroup $bloodGroup)
    {
        return view('admin.blood-groups.show', compact('bloodGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodGroup $bloodGroup)
    {
        return view('admin.blood-groups.edit', compact('bloodGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloodGroupRequest $request, BloodGroup $bloodGroup)
    {
        $bloodGroup->update($request->validated());

        return redirect()->route('admin.blood-groups.index')
            ->with('success', 'Blood group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodGroup $bloodGroup)
    {
        $bloodGroup->delete();

        return redirect()->route('admin.blood-groups.index')
            ->with('success', 'Blood group deleted successfully.');
    }
}
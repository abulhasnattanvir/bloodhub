<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::latest()->paginate(10);
        return view('admin.goals.index', compact('goals'));
    }

    public function create()
    {
        return view('admin.goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string',
            'text' => 'required|string|max:255',
        ]);

        Goal::create($request->all());
        return redirect()->route('admin.goals.index')->with('success', 'Goal added successfully!');
    }

    public function edit(Goal $goal)
    {
        return view('admin.goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'icon' => 'required|string',
            'text' => 'required|string|max:255',
        ]);

        $goal->update($request->all());
        return redirect()->route('admin.goals.index')->with('success', 'Goal updated successfully!');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('admin.goals.index')->with('success', 'Goal deleted successfully!');
    }
}
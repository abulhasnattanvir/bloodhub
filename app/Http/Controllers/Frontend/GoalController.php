<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::all();
        return view('frontend.goals.index', compact('goals')); // or your home page
    }

    public function show(Goal $goal)
    {
        return view('frontend.goals.show', compact('goal'));
    }
}
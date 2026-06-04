<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('frontend.activities.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('frontend.activities.show', compact('activity'));
    }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galleries;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show the about page.
     */
    public function index()
    {
        return view('frontend.about');
    }
    
    public function gallery()
    {
        $galleryImages = Galleries::latest()->paginate(12);
        $categories = Galleries::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('frontend.gallery', compact('galleryImages', 'categories'));
    }
}
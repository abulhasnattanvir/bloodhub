<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function index()
    {
        return view('frontend.contact');
    }
}
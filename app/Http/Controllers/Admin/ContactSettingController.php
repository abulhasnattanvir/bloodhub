<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    
    public function edit()
    {
        $contact = ContactSetting::firstOrCreate(['id' => 1]);
        return view('admin.settings.ContactSetting', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactSetting::firstOrCreate(['id' => 1]);

        $contact->update([
            'page_title'        => $request->page_title,
            'page_subtitle'     => $request->page_subtitle,
            'get_in_touch_text' => $request->get_in_touch_text,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'address'           => $request->address,
            'map_embed'         => $request->map_embed,
            'form_title'        => $request->form_title,
            'success_message'   => $request->success_message,
        ]);

        return back()->with('success', 'Contact page settings updated successfully!');
    }
}
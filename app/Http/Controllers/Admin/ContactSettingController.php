<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class ContactSettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:contact.view', only: ['index', 'show']),
            new Middleware('permission:contact.create', only: ['create', 'store']),
            new Middleware('permission:contact.edit', only: ['edit', 'update']),
            new Middleware('permission:contact.delete', only: ['destroy']),
        ];
    }

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
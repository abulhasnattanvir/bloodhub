<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    public function edit()
    {
        $footer = FooterSetting::firstOrCreate(['id' => 1]);

        return view('admin.settings.FooterSetting', compact('footer'));
    }

    public function update(Request $request)
    {
        $footer = FooterSetting::firstOrCreate(['id' => 1]);

        $footer->update([
            'about_text' => $request->about_text,
            'subscribe_title' => $request->subscribe_title,
            'subscribe_text' => $request->subscribe_text,

            'social_links' => $request->social_links,
            'quick_links' => $request->quick_links,
            'service_links' => $request->service_links,
            'footer_menus' => $request->footer_menus,
        ]);

        return back()->with('success', 'Footer updated successfully');
    }
}
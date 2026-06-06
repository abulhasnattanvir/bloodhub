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

        // Clean & Validate Arrays
        $socialLinks = collect($request->input('social_links', []))
            ->filter(fn($link) => !empty($link['name']) && !empty($link['url']))
            ->values()->toArray();

        $quickLinks = collect($request->input('quick_links', []))
            ->filter(fn($link) => !empty($link['title']) && !empty($link['url']))
            ->values()->toArray();

        $serviceLinks = collect($request->input('service_links', []))
            ->filter(fn($link) => !empty($link['title']) && !empty($link['url']))
            ->values()->toArray();

        $footerMenus = collect($request->input('footer_menus', []))
            ->filter(fn($menu) => !empty($menu['title']) && !empty($menu['url']))
            ->values()->toArray();

        $footer->update([
            'about_text'            => $request->about_text,
            'subscribe_title'       => $request->subscribe_title,
            'subscribe_text'        => $request->subscribe_text,
            'subscribe_placeholder' => $request->subscribe_placeholder,
            'subscribe_button_text' => $request->subscribe_button_text,
            'copyright_text'        => $request->copyright_text,
            'developer_info'        => $request->developer_info,
            'developer_url'        => $request->developer_url,

            'social_links'     => $socialLinks,
            'quick_links'      => $quickLinks,
            'service_links'    => $serviceLinks,
            'footer_menus'     => $footerMenus,
        ]);

        return back()->with('success', 'Footer settings updated successfully!');
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:newsletters,email']);

        // Newsletter model এ সেভ করুন অথবা Mailchimp / Database এ সেভ করুন
        // Newsletter::create(['email' => $request->email]);

        return back()->with('success', 'Thank you for subscribing!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {

            // LOGO UPLOAD
            if ($key === 'logo' && $request->hasFile('logo')) {
                $path = $request->file('logo')->store('settings', 'public');

                Setting::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => $path]
                );

                continue;
            }

            // FAVICON UPLOAD
            if ($key === 'favicon' && $request->hasFile('favicon')) {
                $path = $request->file('favicon')->store('settings', 'public');

                Setting::updateOrCreate(
                    ['key' => 'favicon'],
                    ['value' => $path]
                );

                continue;
            }

            // NORMAL FIELDS
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        return back()->with('success', 'Settings updated successfully');
    }
}
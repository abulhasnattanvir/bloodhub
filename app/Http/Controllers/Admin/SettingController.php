<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class SettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:settings.view', only: ['index', 'show']),
            new Middleware('permission:settings.create', only: ['create', 'store']),
            new Middleware('permission:settings.edit', only: ['edit', 'update']),
            new Middleware('permission:settings.delete', only: ['destroy']),
        ];
    }

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

                // Save logo width
                Setting::updateOrCreate(
                    ['key' => 'hlogoWidth'],
                    ['value' => $request->hlogoWidth]
                );

                // Save logo height
                Setting::updateOrCreate(
                    ['key' => 'hlogoHeight'],
                    ['value' => $request->hlogoHeight]
                );

                continue;
            }

            // FOOTER LOGO UPLOAD
            if ($key === 'flogo' && $request->hasFile('flogo')) {
                $path = $request->file('flogo')->store('settings', 'public');

                Setting::updateOrCreate(
                    ['key' => 'flogo'],
                    ['value' => $path]
                );

                Setting::updateOrCreate(
                    ['key' => 'flogoWidth'],
                    ['value' => $request->hlogoWidth]
                );

                // Save logo height
                Setting::updateOrCreate(
                    ['key' => 'flogoHeight'],
                    ['value' => $request->hlogoHeight]
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
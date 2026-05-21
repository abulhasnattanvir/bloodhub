<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show the application settings form.
     */
    public function index()
    {
        // Get current settings from config or database
        $settings = [
            'site_name' => config('app.name', 'BloodHub'),
            'site_email' => config('mail.from.address', ''),
            'site_phone' => config('settings.site_phone', ''),
            'site_address' => config('settings.site_address', ''),
            'maintenance_mode' => config('settings.maintenance_mode', false),
            'allow_registration' => config('settings.allow_registration', true),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the application settings.
     */
    public function update(UpdateSettingsRequest $request)
    {
        $data = $request->validated();

        // Save settings to config files or database
        // For simplicity, we'll update the .env file or config files
        // In a real application, you might store these in a database table

        // Update .env file
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        // Update each setting in the .env file
        foreach ($data as $key => $value) {
            $key = strtoupper($key);
            if ($value === true || $value === false) {
                $value = $value ? 'true' : 'false';
            }
            $str = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $str);
        }

        file_put_contents($envFile, $str);

        // Clear config cache
        Artisan::call('config:clear');

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
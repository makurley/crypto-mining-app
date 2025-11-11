<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrCreate([]);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();

        $data = $request->except(['_token', '_method', 'touch_icon', 'favicon', 'logo']);

        foreach (['touch_icon', 'favicon', 'logo'] as $field) {
            if ($request->hasFile($field)) {
                $originalName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $request->file($field)->getClientOriginalName());

                $destination = public_path('logo');
                if (!file_exists($destination)) {
                    mkdir($destination, 0775, true);
                }

                $request->file($field)->move($destination, $originalName);

                // Save relative path for logo
                $data[$field] = 'logo/' . $originalName;

                // Optionally update full URL in a 'url' column
                if ($field === 'logo') {
                    $data['url'] = url('public/logo/' . $originalName); // Full browser path
                }
            }
        }

        // Checkbox toggles
        $data['is_announcement'] = $request->has('is_announcement');
        $data['is_adsense'] = $request->has('is_adsense');
        $data['is_analytics'] = $request->has('is_analytics');
        $data['is_youtube_link'] = $request->has('is_youtube_link');

        $settings->update($data);

        return back()->with('success', 'Settings updated successfully!');
    }
}
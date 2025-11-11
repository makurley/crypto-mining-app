<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralSetting;
use Illuminate\Http\Request;

class ReferralSettingsController extends Controller
{
    public function edit()
    {
        $settings = ReferralSetting::firstOrCreate([], [
            'bonus_amount' => 1.00,
            'referral_active' => true
        ]);

        return view('admin.referral-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bonus_amount' => 'required|numeric|min:0',
            'referral_active' => 'required|boolean',
        ]);

        $settings = ReferralSetting::first();
        if (!$settings) {
            $settings = new ReferralSetting();
        }

        $settings->bonus_amount = $request->bonus_amount;
        $settings->referral_active = $request->referral_active;
        $settings->save();

        return redirect()->back()->with('success', 'Referral settings updated successfully.');
    }
}

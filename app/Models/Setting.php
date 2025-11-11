<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title', 'description', 'phone', 'address', 'email',
        'touch_icon', 'favicon', 'logo',
        'facebook', 'twitter', 'instagram', 'telegram', 'whatsapp',
        'currency', 'currency_code', 'primary_color',
        'custom_css', 'custom_js',
        'is_announcement', 'announcement',
        'is_adsense', 'google_adsense',
        'is_analytics', 'google_analytics_id',
        'is_youtube_link', 'youtube_link'
    ];

    // Updated helper to match new path
    public function getLogoUrlAttribute()
    {
        if ($this->logo && file_exists(public_path($this->logo))) {
            return asset($this->logo);
        }

        // fallback image
        return asset('images/default-logo.png');
    }
}

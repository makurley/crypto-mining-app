<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch blog posts
        $posts = BlogPost::latest()->take(5)->get();

        // Fetch crypto rates
        $prices = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => 'bitcoin,ethereum,tether',
            'vs_currencies' => 'usd'
        ])->json();

        $cryptoRates = [
            'Bitcoin' => $prices['bitcoin']['usd'] ?? 0,
            'Ethereum' => $prices['ethereum']['usd'] ?? 0,
            'USDT' => $prices['tether']['usd'] ?? 0,
        ];

        // Fetch plans
        $plans = Plan::with('asset')->latest()->get();

        
        return view('home', [
    'plans' => $plans,
    'cryptoRates' => $cryptoRates,
    'posts' => $posts,
]);
    }
}

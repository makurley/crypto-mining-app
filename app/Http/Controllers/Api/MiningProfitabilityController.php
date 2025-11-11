<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MiningProfitabilityController extends Controller
{
    public function index()
    {
        $response = Http::withoutVerifying()->get('https://whattomine.com/coins.json');

        if (!$response->successful()) {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }

        $coins = $response->json()['coins'] ?? [];

        $results = collect($coins)
            ->map(function ($coin, $coinName) {
                // Add the coin name from the key
                $coin['name'] = $coinName;
                return $coin;
            })
            ->filter(function ($coin) {
                return isset($coin['name'], $coin['tag'], $coin['profitability'], $coin['btc_revenue'], $coin['exchange_rate']);
            })
            ->sortByDesc('profitability')
            ->take(5)
            ->map(function ($coin) {
                return [
                    'name' => $coin['name'],
                    'symbol' => $coin['tag'],
                    'profitability' => round($coin['profitability'], 2),
                    'revenue_usd_per_day' => round($coin['btc_revenue'] * $coin['exchange_rate'], 10), // Increased precision
                    'updated_at' => now()->toDateTimeString(),
                ];
            })
            ->values();

        return response()->json($results);
    }
}

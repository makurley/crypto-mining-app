<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MiningProfitabilityController;

Route::get('/mining-profitability', [MiningProfitabilityController::class, 'index']);

Route::get('/crypto-prices', function () {
    $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
        'ids' => 'bitcoin,ethereum',
        'vs_currencies' => 'usd',
    ]);

    return response()->json($response->json());
});

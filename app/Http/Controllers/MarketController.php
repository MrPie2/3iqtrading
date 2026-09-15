<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
   public function ticker()
{
    $token = config('services.marketdata.token');

    $response = Http::get(
        'https://api.marketdata.app/v1/stocks/quotes/AAPL/',
        [
            'token' => $token
        ]
    );

    return response()->json([
        'status' => $response->status(),
        'data' => $response->json(),
    ]);
}
}
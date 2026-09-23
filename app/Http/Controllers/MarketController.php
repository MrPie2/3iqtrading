<?php
namespace App\Http\Controllers;

use App\Services\MarketChartService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    public function __construct(private readonly MarketChartService $market) {}

    public function ticker()
    {
        return response()->json($this->market->snapshot());
    }

    public function crypto()
    {
        try {
            $data = Cache::remember('dashboard.crypto.market', now()->addSeconds(45), function () {
                return Http::timeout(10)->retry(2, 300)
                    ->get('https://api.coingecko.com/api/v3/coins/markets', [
                        'vs_currency' => 'usd',
                        'ids' => 'bitcoin,ethereum,tether,binancecoin,solana,ripple,usd-coin,dogecoin,cardano,avalanche-2',
                        'order' => 'market_cap_desc',
                        'per_page' => 10,
                        'page' => 1,
                        'sparkline' => 'true',
                        'price_change_percentage' => '24h,7d',
                    ])->throw()->json();
            });

            return response()->json($data)->header('Cache-Control', 'no-store');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Market feed is temporarily unavailable. Please try again shortly.',
            ], 502);
        }
    }
}

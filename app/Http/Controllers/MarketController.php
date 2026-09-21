<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
class MarketController extends Controller
{
    public function crypto(){
        try{
            $data=Http::timeout(8)->get('https://api.coingecko.com/api/v3/coins/markets',[
                'vs_currency'=>'usd','ids'=>'bitcoin,ethereum,binancecoin,solana,ripple','sparkline'=>'true'
            ])->throw()->json();
            return response()->json($data);
        }catch(\Throwable $e){
            return response()->json(['message'=>'Market feed is temporarily unavailable.'],502);
        }
    }
}

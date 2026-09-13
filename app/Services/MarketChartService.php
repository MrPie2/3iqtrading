<?php

namespace App\Services;

use App\Models\MarketAsset;

class MarketChartService
{
    public function snapshot(): array
    {
        return MarketAsset::query()
            ->orderBy('symbol')
            ->get()
            ->map(fn (MarketAsset $asset) => [
                'symbol' => $asset->symbol,
                'name' => $asset->name,
                'price' => (float) $asset->price,
                'change' => (float) $asset->change_percent,
                'category' => $asset->category,
            ])->all();
    }

    public function chartSeries(): array
    {
        return [
            'labels' => ['09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00'],
            'values' => [184.20, 185.10, 184.75, 186.30, 187.10, 186.55, 188.20, 189.05],
        ];
    }
}

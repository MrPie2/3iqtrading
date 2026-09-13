<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\InvestmentPlan;
use App\Models\MarketAsset;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        InvestmentPlan::query()->create([
            'name' => 'Starter Growth', 'minimum_amount' => 500, 'maximum_amount' => 4999,
            'term_label' => 'Flexible', 'risk_level' => 'Moderate', 'illustrative_rate' => 0,
            'description' => 'A starter plan layout for smaller investment goals.',
            'features' => ['Flexible presentation', 'Goal-oriented education', 'Online account access'], 'featured' => false,
        ]);
        InvestmentPlan::query()->create([
            'name' => 'Balanced Portfolio', 'minimum_amount' => 5000, 'maximum_amount' => 24999,
            'term_label' => 'Medium term', 'risk_level' => 'Moderate', 'illustrative_rate' => 0,
            'description' => 'A balanced product card for a diversified investment offering.',
            'features' => ['Diversification focus', 'Portfolio education', 'Account support'], 'featured' => true,
        ]);
        InvestmentPlan::query()->create([
            'name' => 'Long-Term Select', 'minimum_amount' => 25000, 'maximum_amount' => null,
            'term_label' => 'Long term', 'risk_level' => 'Higher', 'illustrative_rate' => 0,
            'description' => 'A premium layout for long-term investment products.',
            'features' => ['Long-term focus', 'Research-ready', 'Future dashboard integration'], 'featured' => false,
        ]);

        $faqs = [
            ['question'=>'Is this site connected to a live brokerage or market feed?', 'answer'=>'No. The starter includes demo market data for the interface. Connect an approved provider before displaying live prices or executing trades.', 'sort_order'=>1],
            ['question'=>'Can I change the investment plans?', 'answer'=>'Yes. The plans are stored in the investment_plans table and are rendered by the InvestmentPlanService, so you can replace the seed data with your approved products.', 'sort_order'=>2],
            ['question'=>'Are returns guaranteed?', 'answer'=>'No. The template deliberately does not promise returns. Investment products carry risk, and all product claims should be verified before launch.', 'sort_order'=>3],
            ['question'=>'Will there be a client dashboard?', 'answer'=>'Yes, the authentication foundation is ready for a future protected dashboard with portfolios, orders, balances, notifications and statements.', 'sort_order'=>4],
            ['question'=>'Can the Laravel backend serve an Ionic app later?', 'answer'=>'Yes. The same models and services can be exposed through API controllers and authentication endpoints when the mobile frontend is connected.', 'sort_order'=>5],
        ];
        foreach ($faqs as $faq) Faq::query()->create($faq);

        foreach ([
            ['symbol'=>'AAPL','name'=>'Apple Inc.','price'=>189.05,'change_percent'=>2.10,'category'=>'stock'],
            ['symbol'=>'MSFT','name'=>'Microsoft Corp.','price'=>423.11,'change_percent'=>1.35,'category'=>'stock'],
            ['symbol'=>'NVDA','name'=>'NVIDIA Corp.','price'=>139.80,'change_percent'=>3.22,'category'=>'stock'],
            ['symbol'=>'SPY','name'=>'S&P 500 ETF','price'=>555.60,'change_percent'=>0.86,'category'=>'etf'],
        ] as $asset) MarketAsset::query()->create($asset);
    }
}

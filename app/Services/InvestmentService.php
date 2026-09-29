<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\InvestmentPlan;
use App\Models\Investor;
use Illuminate\Support\Facades\DB;

class InvestmentService
{
    public function createPlanInvestment(Investor $investor, InvestmentPlan $plan, float $displayAmount): Contract
    {
        return DB::transaction(function () use ($investor, $plan, $displayAmount) {
            $investor = Investor::query()
                ->where('Investor_id', $investor->Investor_id)
                ->lockForUpdate()
                ->firstOrFail();

            $displayAmount = round($displayAmount, 2);
            $exchangeRate = max((float) $investor->exchangerate, 0.000001);
            $amount = round($displayAmount / $exchangeRate, 2);

            $minimum = (float) $plan->minimum_amount;
            $maximum = $plan->maximum_amount !== null ? (float) $plan->maximum_amount : null;
            $available = (float) $investor->Total_Deposit;

            if ($displayAmount < $minimum) {
                throw new \RuntimeException('The minimum investment for this plan is $' . number_format($minimum, 2) . '.');
            }

            if ($maximum !== null && $displayAmount > $maximum) {
                throw new \RuntimeException('The maximum investment for this plan is $' . number_format($maximum, 2) . '.');
            }

            if ($amount <= 0 || $amount > $available) {
                throw new \RuntimeException('Insufficient available balance.');
            }

            $duration = max(1, (int) ($plan->duration_days ?: 30));
            $interest = (float) ($plan->illustrative_rate ?? 0);
            $roi = round($amount + ($amount * $interest / 100), 2);

            $contract = Contract::create([
                'Investor_id' => $investor->Investor_id,
                'Investor_Name' => $investor->First_Name,
                'Plan_Type' => $plan->name,
                'Country' => $investor->Nationality,
                'Contract_id' => random_int(10000000, 999999999),
                'Amount' => $amount,
                'Interest' => $interest,
                'Date_Entered' => now()->format('l d F Y'),
                'Contract_Duration' => $duration,
                'Contract_Start' => now(),
                'Timer' => 0,
                'ROI' => $roi,
                'PrevSettled' => now()->addDay()->timestamp,
                'Remaining' => $duration,
                'Status' => 1,
            ]);

            $investor->decrement('Total_Deposit', $amount);

            return $contract;
        });
    }

    public function settleDueInvestments(): int
    {
        $settled = 0;

        Contract::query()
            ->where('Status', 1)
            ->where('Remaining', '>', 0)
            ->chunkById(100, function ($contracts) use (&$settled) {
                foreach ($contracts as $contract) {
                    DB::transaction(function () use ($contract, &$settled) {
                        $investor = Investor::where('Investor_id', $contract->Investor_id)->lockForUpdate()->first();
                        if (!$investor) {
                            return;
                        }

                        $daysElapsed = now()->diffInDays($contract->Contract_Start);
                        $duration = max(1, (int) $contract->Contract_Duration);

                        if ($daysElapsed >= $duration) {
                            $profit = ((float) $contract->Amount * (float) $contract->Interest / 100) * (int) $contract->Remaining;
                            $investor->increment('Fin_Asset', round($profit, 2));
                            $investor->increment('Fin_Asset', (float) $contract->Amount);
                            $contract->update(['Remaining' => 0, 'Status' => 2, 'PrevSettled' => 0]);
                            $settled++;
                            return;
                        }

                        if (!$contract->PrevSettled || now()->timestamp >= (int) $contract->PrevSettled) {
                            $profit = (float) $contract->Amount * (float) $contract->Interest / 100;
                            $investor->increment('Fin_Asset', round($profit, 2));
                            $remaining = max(0, (int) $contract->Remaining - 1);
                            $contract->update([
                                'PrevSettled' => now()->addDay()->timestamp,
                                'Remaining' => $remaining,
                            ]);
                            $settled++;
                        }
                    });
                }
            });

        return $settled;
    }
}

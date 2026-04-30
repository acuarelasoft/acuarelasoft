<?php

namespace App\Support;

class IntakeEstimator
{
    /**
     * @param  list<string>  $moduleIds
     * @return array{score:int,size:string,budget_tier:string}
     */
    public static function estimate(array $moduleIds): array
    {
        $weights = config('intake.complexity_weights', []);
        $score = 0;

        foreach ($moduleIds as $moduleId) {
            $complexity = (string) data_get(IntakeModuleCatalog::module($moduleId), 'complexity', 'media');
            $score += (int) ($weights[$complexity] ?? 3);
        }

        $sizeThresholds = config('intake.size_thresholds', []);
        $size = 'XL';

        if ($score <= (int) ($sizeThresholds['S'] ?? 10)) {
            $size = 'S';
        } elseif ($score <= (int) ($sizeThresholds['M'] ?? 25)) {
            $size = 'M';
        } elseif ($score <= (int) ($sizeThresholds['L'] ?? 45)) {
            $size = 'L';
        }

        $budgetThresholds = config('intake.budget_tier_thresholds', []);
        $budgetTier = 'high';

        if ($score <= (int) ($budgetThresholds['low'] ?? 15)) {
            $budgetTier = 'low';
        } elseif ($score <= (int) ($budgetThresholds['medium'] ?? 35)) {
            $budgetTier = 'medium';
        }

        return [
            'score' => $score,
            'size' => $size,
            'budget_tier' => $budgetTier,
        ];
    }
}

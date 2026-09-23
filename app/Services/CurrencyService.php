<?php

namespace App\Services;

use App\Models\SiteSetting;

class CurrencyService
{
    protected static array $rates = [
        'USD' => 1.0,
        'CLP' => 950.0,
        'EUR' => 0.92,
        'MXN' => 19.8,
    ];

    public static function getRates(): array
    {
        $raw = SiteSetting::get('currency_rates');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                return array_merge(self::$rates, $decoded);
            }
        }
        return self::$rates;
    }

    public static function convert(float $amount, string $from = 'USD', string $to = 'USD'): float
    {
        $rates = self::getRates();
        $from = strtoupper($from);
        $to = strtoupper($to);

        $fromRate = $rates[$from] ?? 1.0;
        $toRate = $rates[$to] ?? 1.0;

        // Convert to USD first then to target
        $inUsd = $amount / $fromRate;
        return round($inUsd * $toRate, 2);
    }

    public static function format(float $amount, string $currency = 'USD'): string
    {
        $currency = strtoupper($currency);

        return match ($currency) {
            'CLP' => '$' . number_format($amount, 0, ',', '.') . ' CLP',
            'EUR' => '€' . number_format($amount, 2, ',', '.') . ' EUR',
            'MXN' => '$' . number_format($amount, 2, '.', ',') . ' MXN',
            default => '$' . number_format($amount, 2, '.', ',') . ' USD',
        };
    }
}

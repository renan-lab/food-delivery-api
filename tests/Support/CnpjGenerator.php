<?php

declare(strict_types=1);

namespace Tests\Support;

final class CnpjGenerator
{
    public static function makeAlphanumeric(): string
    {
        $base = '';

        for ($i = 0; $i < 12; $i++) {
            $base .= fake()->randomElement([
                ...range('A', 'Z'),
                ...range('0', '9'),
            ]);
        }

        return $base
            .self::calculateDigit($base)
            .self::calculateDigit($base.self::calculateDigit($base));
    }

    private static function calculateDigit(string $value): int
    {
        $weights = strlen($value) === 12
            ? [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
            : [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $sum = 0;

        foreach (str_split($value) as $index => $character) {
            $sum += (ord($character) - 48) * $weights[$index];
        }

        $remainder = $sum % 11;

        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}

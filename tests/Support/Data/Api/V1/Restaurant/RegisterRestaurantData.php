<?php

declare(strict_types=1);

namespace Tests\Support\Data\Api\V1\Restaurant;

use Faker\Generator;

final class RegisterRestaurantData
{
    private static function faker(): Generator
    {
        return app(Generator::class);
    }

    public static function valid(array $override = []): array
    {
        return array_replace([
            'trade_name' => self::faker()->company(),
            'company_name' => self::faker()->company().' LTDA',
            'cnpj' => self::faker()->numerify('##############'),
            'email' => self::faker()->unique()->safeEmail(),
            'password' => 'Password@123',
            'phone' => self::faker()->numerify('119########'),
            'postal_code' => self::faker()->numerify('########'),
            'street' => self::faker()->streetName(),
            'number' => self::faker()->buildingNumber(),
            'complement' => null,
            'district' => self::faker()->citySuffix(),
            'city' => self::faker()->city(),
            'state' => 'SP',
        ], $override);
    }
}

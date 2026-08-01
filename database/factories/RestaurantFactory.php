<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Restaurant>
 */
class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trade_name' => fake()->company(),
            'company_name' => fake()->company().' LTDA',
            'cnpj' => fake()->unique()->numerify('##############'),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'Password@123',
            'phone' => fake()->numerify('119########'),
            'postal_code' => fake()->numerify('########'),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => null,
            'district' => fake()->citySuffix(),
            'city' => fake()->city(),
            'state' => fake()->randomElement([
                'AC',
                'AL',
                'AP',
                'AM',
                'BA',
                'CE',
                'DF',
                'ES',
                'GO',
                'MA',
                'MT',
                'MS',
                'MG',
                'PA',
                'PB',
                'PR',
                'PE',
                'PI',
                'RJ',
                'RN',
                'RS',
                'RO',
                'RR',
                'SC',
                'SP',
                'SE',
                'TO',
            ]),
            'is_active' => true,
            'email_verified_at' => null,
        ];
    }

    public function withInvalidEmail(): static
    {
        return $this->state(fn () => [
            'email' => 'invalid-email',
        ]);
    }
}

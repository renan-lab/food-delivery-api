<?php

declare(strict_types=1);

use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;

it('creates a restaurant successfully', function () {
    $payload = Restaurant::factory()->raw();

    $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

    $response->assertCreated();

    $this->assertDatabaseHas(Restaurant::class, [
        'email' => $payload['email'],
        'cnpj' => $payload['cnpj'],
    ]);

    $this->assertDatabaseCount(Restaurant::class, 1);
});

describe('password security', function () {

    it('stores the password hashed', function () {
        $payload = Restaurant::factory()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertCreated();

        $restaurant = Restaurant::first();

        expect(Hash::check($payload['password'], $restaurant->password))->toBeTrue();

        expect($restaurant->password)->not->toBe($payload['password']);
    });

    it('does not expose the password in the response', function () {
        $payload = Restaurant::factory()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertCreated()
            ->assertJsonMissingPath('password');
    });
});

describe('email validation', function () {
    it('requires a valid email', function () {
        $payload = Restaurant::factory()->withInvalidEmail()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('email');

        $this->assertDatabaseCount(Restaurant::class, 0);
    });

    it('requires a unique email', function () {
        $firstRestaurant = Restaurant::factory()->create();

        $payload = Restaurant::factory()->raw(['email' => $firstRestaurant['email']]);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('email');

        $this->assertDatabaseCount(Restaurant::class, 1);
    });
});

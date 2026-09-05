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

describe('password validation', function () {
    it('requires a password', function () {
        $payload = Restaurant::factory()->raw(['password' => null]);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('password');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires letters', function () {
        $payload = Restaurant::factory()->raw(['password' => '12345678']);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('password');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires mixed case', function () {
        $payload = Restaurant::factory()->raw(['password' => '123abcd8']);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('password');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires numbers', function () {
        $payload = Restaurant::factory()->raw(['password' => 'ABCdefgh']);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('password');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires symbols', function () {
        $payload = Restaurant::factory()->raw(['password' => '123ABcd8']);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('password');

        $this->assertDatabaseEmpty(Restaurant::class);
    });
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
    it('requires an email', function () {
        $payload = Restaurant::factory()->raw(['email' => null]);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('email');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires a valid email', function () {
        $payload = Restaurant::factory()->withInvalidEmail()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('email');

        $this->assertDatabaseEmpty(Restaurant::class);
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

describe('cnpj validation', function () {
    it('requires a cnpj', function () {
        $payload = Restaurant::factory()->raw(['cnpj' => null]);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('cnpj');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('requires a valid numeric cnpj', function () {
        $payload = Restaurant::factory()->withInvalidNumericCnpj()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('cnpj');

        $this->assertDatabaseEmpty(Restaurant::class);
    });

    it('accepts a valid alphanumeric cnpj', function () {
        $payload = Restaurant::factory()->withAlphanumericCnpj()->raw();

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertCreated();

        $this->assertDatabaseCount(Restaurant::class, 1);

        $this->assertDatabaseHas(Restaurant::class, [
            'cnpj' => $payload['cnpj'],
        ]);
    });

    it('requires a unique cnpj', function () {
        $firstRestaurant = Restaurant::factory()->create();

        $payload = Restaurant::factory()->raw(['cnpj' => $firstRestaurant['cnpj']]);

        $response = $this->postJson(route('api.v1.restaurants.store'), $payload);

        $response->assertUnprocessable()
            ->assertInvalid('cnpj');

        $this->assertDatabaseCount(Restaurant::class, 1);
    });
});

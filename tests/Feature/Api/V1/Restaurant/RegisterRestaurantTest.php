<?php

declare(strict_types=1);

use App\Models\Restaurant;

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

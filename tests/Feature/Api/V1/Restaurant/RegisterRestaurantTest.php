<?php

declare(strict_types=1);

use Tests\Support\Data\Api\V1\Restaurant\RegisterRestaurantData;

it('creates a restaurant successfully', function () {
    $payload = RegisterRestaurantData::valid();

    $response = $this->postJson('/api/v1/restaurants', $payload);

    $response->assertCreated();

    $this->assertDatabaseHas('restaurants', [
        'email' => $payload['email'],
        'cnpj' => $payload['cnpj'],
    ]);
});

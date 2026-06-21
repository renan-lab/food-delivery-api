<?php

namespace Tests\Feature;

test('example_test', function () {
    $response = $this->get('/');

    $response->assertOk();
});

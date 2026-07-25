<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::controller(RestaurantController::class)
    ->prefix('restaurants')
    ->name('restaurants.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
    });

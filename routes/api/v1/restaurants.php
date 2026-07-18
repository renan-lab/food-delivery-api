<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::post('restaurants', [RestaurantController::class, 'store']);

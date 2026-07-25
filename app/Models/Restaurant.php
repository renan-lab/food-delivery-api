<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RestaurantFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Override;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

#[UseFactory(RestaurantFactory::class)]
#[Fillable([
    'trade_name',
    'company_name',
    'cnpj',
    'email',
    'password',
    'phone',
    'postal_code',
    'street',
    'number',
    'complement',
    'district',
    'city',
    'state',
    'is_active',
])]
#[Hidden([
    'password',
])]
class Restaurant extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<RestaurantFactory> */
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    #[Override]
    public function getJWTIdentifier(): int|string
    {
        return $this->getKey();
    }

    /**
     * @return array<string, mixed>
     */
    #[Override]
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Email;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Email::defaults(function (): Email {
            $rule = new Email;

            $rule->rfcCompliant();

            if (! $this->app->environment('testing')) {
                $rule->validateMxRecord();
            }

            $rule->preventSpoofing();

            return $rule;
        });
    }
}

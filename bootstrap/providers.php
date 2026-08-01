<?php

use App\Providers\AppServiceProvider;
use App\Providers\EmailServiceProvider;
use App\Providers\PasswordServiceProvider;

return [
    AppServiceProvider::class,
    EmailServiceProvider::class,
    PasswordServiceProvider::class,
];

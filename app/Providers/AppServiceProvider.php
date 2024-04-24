<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
// Although not typically required, you are free to extend the PersonalAccessToken model used internally by Sanctum:

// use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

// class PersonalAccessToken extends SanctumPersonalAccessToken
// {
//     // ...
// }

// Then, you may instruct Sanctum to use your custom model via the usePersonalAccessTokenModel method provided by Sanctum.
// Typically, you should call this method in the boot method of one of your application's service providers (---THIS File---):

// use App\Models\Sanctum\PersonalAccessToken;
// use Laravel\Sanctum\Sanctum;

// /**
//  * Bootstrap any application services.
//  */
// public function boot(): void
// {
//     Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
// }

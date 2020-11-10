<?php

namespace JorgeAnzola\PhoneNumberVerification\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JorgeAnzola\PhoneNumberVerification\Http\Middleware\EnsurePhoneNumberIsVerified;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->getConfig(), 'phone-number-verification');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'phone-number-verification');

        $router->aliasMiddleware('verified_phone_number', EnsurePhoneNumberIsVerified::class);
    }

    protected function getConfig()
    {
        return __DIR__ . '/../../config/config.php';
    }
}

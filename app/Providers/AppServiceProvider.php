<?php

namespace App\Providers;
use App\Helpers\ResponseHelper;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\Handler;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en', 'ku'])
                ->visible(outsidePanels: true);
        });
        RateLimiter::for('login_secure', function (Request $request) {
            $identifier = (string) $request->input('identifier', 'guest');
            $ip = $request->ip();
            return [
                Limit::perMinutes(1, 3)
                    ->by('login_attempts_user:'.$identifier)
                    ->response(function (Request $request, array $headers) {
                        return ResponseHelper::error(
                            'Too many attempts Try again in '.ceil($headers['Retry-After'] / 60).' minutes',
                            429
                        );
                    }),
                Limit::perMinutes(1,10)
                    ->by('login_attempts_ip:'.$ip)
                    ->response(function () {
                        return ResponseHelper::error(
                            'Too many attempts Try again later',
                            429
                        );
                    }),
            ];
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    private ?int $userType;

    public function __construct($app, ?int $userType = null)
    {
        parent::__construct($app);
        $this->userType = $userType;
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        Route::middleware('web')
            ->namespace('App\Http\Controllers\ControlPanel')
            ->group(base_path('routes/control_panel.php'));

        Route::middleware('web')
            ->namespace('App\Http\Controllers\ControlPanel\Admin')
            ->group(base_path('routes/control_panel_admin.php'));

        Route::middleware('web')
            ->namespace('App\Http\Controllers\ControlPanel\Seller')
            ->group(base_path('routes/control_panel_seller.php'));

        Route::middleware('web')
            ->namespace('App\Http\Controllers\ControlPanel\Client')
            ->group(base_path('routes/control_panel_client.php'));
      
      Route::middleware('web')
            ->namespace('App\Http\Controllers\ControlPanel\FinCompany')
            ->group(base_path('routes/control_panel_fin.php'));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

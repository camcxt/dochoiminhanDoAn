<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    const STATUS_ACTIVE = 1;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $categories = DB::table('categories')->where('active', self::STATUS_ACTIVE)->get();
        $brands = DB::table('brands')->where('active', self::STATUS_ACTIVE)->get();
        view()->share(['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}

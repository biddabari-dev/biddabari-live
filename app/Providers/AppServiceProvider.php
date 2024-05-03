<?php

namespace App\Providers;

use App\Models\Backend\AdditionalFeatureManagement\SiteSetting;
use App\Models\Backend\NoticeManagement\Notice;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        View::composer(['frontend.includes.header'], function ($view){
            $view->with('scrollingNotices', Notice::where(['status'=> 1, 'type' => 'scroll'])->take(6)->get());
        });
        View::share('siteSettings', SiteSetting::first());
    }
}

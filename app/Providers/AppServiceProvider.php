<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['frontend.body.header', 'frontend.body.footer', 'frontend.body.brands'], function ($view) {
            $view->with('categories', Category::orderBy('category_name_en')->get());
        });
    }
}

<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;

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
     
        Paginator::useBootstrap();
        App::setLocale(Session::get('locale', config('app.locale')));

     view()->composer('layouts.main', function ($view) {
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Auth::user()->productsInCart->map(function ($product) {
                return [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $product->pivot->quantity,
                'image' => $product->image ?? 'default-image.jpg',
            ];
                    });
        }

        $view->with('cartItems', $cartItems);
    });
}
}

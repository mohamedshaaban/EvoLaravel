<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use Encore\Admin\Config\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Notifications;

use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $lang = App::getLocale();
            $user = Auth::user();
            $view->with('currencies', Currency::where('status', 1)->get());
            $view->with('menucategries', Category::where('menu', 1)->get());
            $view->with('countries', Country::where('status',1)->get());
            $view->with('setting', Setting::first());
            $view->with('lang', $lang);
             // user notifiaction
            $user = Auth::user();
            if ($user != null) {
                $view->with('notifications', Notifications::where('user_to', $user->id)->get());
            } else {
                $view->with('notifications', '');
            }

            // set user country in session
            if (!session()->get('country')) {
                if ($user && $user->country_id != 0) {
                    $view->with('selectedcountry', Country::where('id', $user->country_id)->first());
                    session()->put('country', Country::where('code', 'KWD')->first(['id'])->id);
                    session()->save();
                } else {
                    $view->with('selectedcountry', Country::where('code', 'KWD')->first());
                    session()->put('country', Country::where('code', 'KWD')->first(['id'])->id);
                    session()->save();
                }
                return \App::make('redirect')->refresh();
            } else {
                $view->with('selectedcountry', Country::where('id', session()->get('country'))->first());

            }
            // end set user country in session

            
            // set currency in session
            if (!session()->get('currency')) {
                $currency = Currency::where('country_id', session()->get('country'))->first();
                if (!is_null($currency)) {
                    $view->with('selected_currency', $currency);
                    session()->put('currency', $currency->code);
                    session()->save();
                } else {
                    $view->with('selected_currency', Currency::where('code', Setting::first()->default_currency)->first());
                    session()->put('currency', Currency::where('code', Setting::first()->default_currency));
                    session()->save();
                }
            } else {
                $currency = Currency::where('code', session()->get('currency'))->first();
                $view->with('selected_currency', $currency);
            }
            // end set currency in session
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Country as Country;  //country model
use Closure;
use Request;
use Route;

class CountryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $countryShortcode = $request->route('country');
        if(!$request->route('country')){$countryShortcode='kwd';}
        $routeName = $request->route()->getName();
        $routeParameters = $request->route()->parameters();
        if ($request->session()->has('redirect_to_country')) {
            $redirectTo = $request->session()->get('redirect_to_country');
            if ($country === $redirectTo) {
                $request->session()->forget('redirect_to_country');
            } else {
                $routeParameters['country'] = $redirectTo;
                return redirect()->route($routeName, $routeParameters);
            }
        }
        $country = Country::where('code', '=', $countryShortcode)->first();
        if ($country === null) {
            return redirect('/');
        }
        $request->session()->put('country', $country->id);
        $request->session()->save();
        return redirect()->back();

    }

}

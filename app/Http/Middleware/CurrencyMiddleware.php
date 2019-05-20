<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Currency;

class CurrencyMiddleware
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
        $currencyShortcode = $request->route('currency');
        if (!$request->route('currency')) {
            $currencyShortcode = 'kwd';
        }
        $routeName = $request->route()->getName();
        $routeParameters = $request->route()->parameters();
        if ($request->session()->has('redirect_to_currency')) {
            $redirectTo = $request->session()->get('redirect_to_currency');
            if ($currency === $redirectTo) {
                $request->session()->forget('redirect_to_currency');
            } else {
                $routeParameters['currency'] = $redirectTo;
                return redirect()->route($routeName, $routeParameters);
            }
        }
        $currency = Currency::where('code', '=', $currencyShortcode)->first();
        if ($currency === null) {
            return redirect('/');
        }
        $request->session()->put('currency', $currency->code);
        $request->session()->save();
        return redirect()->back();

    }
}

<?php

namespace App\Http\Middleware;

use Closure, Session;

class SwitchLang
{

    protected $languages = ['en', 'ar'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('locale')) {
            Session::put('locale', $request->getPreferredLanguage($this->languages));
        }
//        dd(Session::get('locale'));
        app()->setLocale(Session::get('locale'));


        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('app_locale', 'en'); // default is English
        App::setLocale($locale);

        return $next($request);
    }
}

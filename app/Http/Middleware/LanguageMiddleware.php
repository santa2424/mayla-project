<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasSession()) {
        if (Auth::check()) {
            App::setLocale(Auth::user()->preferred_language ?? config('app.locale'));
        } elseif ($request->session()->has('locale')) {
            App::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(config('app.locale'));
        }
    }
        return $next($request);
    }
}

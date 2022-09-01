<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Local
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $isLangSelect = '';
        if (!$request->expectsJson()) {
            $isLangSelect = session()->get('lang') ?? 'ar';
        } else {
            $isLangSelect = $request->header('lang') ?? 'ar';
        }
        App::setlocale($isLangSelect);
        return $next($request);
    }
}

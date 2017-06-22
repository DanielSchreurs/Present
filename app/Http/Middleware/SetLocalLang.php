<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class SetLocalLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        setlocale(LC_ALL, 'fr_FR');
        return $next($request);
    }
}

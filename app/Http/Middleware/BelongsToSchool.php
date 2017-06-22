<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class BelongsToSchool
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
        if(empty(\Auth::user()->schools->toArray())){
            Flash::error('Oups, vous devez faire une demande  d’adhésion à une école ou créer la vôtre avant.');
            return redirect()->action('Www\PageController@dashboard');
        }
        return $next($request);
    }
}

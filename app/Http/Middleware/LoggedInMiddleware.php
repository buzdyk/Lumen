<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;

class LoggedInMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return new Response('', 401);
        }

        return $next($request);
    }

}

<?php

namespace App\Http\Middleware;

use Closure;

class Player
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
        $user = $request->user();
        if($user && $user->getRole()->name == 'player') {
            return $next($request);
        }

        return redirect()->route('home');
    }
}

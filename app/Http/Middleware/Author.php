<?php

namespace App\Http\Middleware;

use Closure;

class Author
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

        if ($user && ($user->getRole()->name === 'administrator' || $user->getRole()->name === 'author')) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}

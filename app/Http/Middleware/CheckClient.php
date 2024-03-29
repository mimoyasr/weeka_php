<?php

namespace App\Http\Middleware;

use Closure;
use \JWTAuth as Auth;

class CheckClient
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
        if (Auth::getToken()) {
            $user = Auth::toUser(Auth::getToken());
            if ($user->type === 'client') {
                return $next($request);
            } else {
                return response()->json(['message' => 'Not Allowed'], 404);
            }
        } else {
            return response()->json(['message' => 'Not Allowed'], 404);
        }
    }
}

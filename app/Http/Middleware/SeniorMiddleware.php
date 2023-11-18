<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use  Log;
class SeniorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        $user = auth('sanctum')->user();
        Log::info($user->role);
        if ($user->role!=2) {
            return response()->json(['error' => 'This resource is only accessible by seniors.'], 401);
        }
        return $next($request);
    }
}

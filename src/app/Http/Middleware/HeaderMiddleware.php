<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        $response = $next($request);

        $executionTime = microtime(true) - $startTime;

        $memoryUsage = memory_get_peak_usage() / 1024 / 1024;

        $response->headers->set('X-Debug-Time', $executionTime);
        $response->headers->set('X-Debug-Memory', round($memoryUsage, 2));

        return $response;
    }
}

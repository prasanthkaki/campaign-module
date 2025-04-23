<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = apache_request_headers();
        $token = $headers['token'] ?? null;
        if(empty($token) || !$this->validateToken($token)) {
            return Response('Please send the valid Parameters', 401);
        }
        return $next($request);
    }

    public function validateToken($token) {
        if((env('APP_ENV') == 'local') && $token == '1q2w3e4r5t6y') {
            return true;
        }
        return false;
    }
}

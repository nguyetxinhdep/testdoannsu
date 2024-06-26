<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
       // Kiểm tra nếu yêu cầu là yêu cầu API
        if ($request->expectsJson() || $this->isApiRequest($request)) {
            // Trả về route dành cho yêu cầu API không xác thực
            return route('api.unauthenticated');
        }

        // Trả về route dành cho yêu cầu web không xác thực
        return route('login');
    }

    /**
     * Kiểm tra xem yêu cầu có phải là yêu cầu API không
     */
    private function isApiRequest(Request $request): bool
    {
        // Kiểm tra xem yêu cầu có header Authorization không (thường được sử dụng cho API)
        if ($request->hasHeader('Authorization')) {
            return true;
        }

        // Kiểm tra nếu URL chứa 'api'
        if ($request->is('api/*')) {
            return true;
        }

        return false;
    }
}

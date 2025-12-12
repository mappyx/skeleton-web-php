<?php

namespace System;

class CsrfMiddleware
{
    /**
     * Verify CSRF token for state-changing requests
     */
    public static function verify(Request $request): bool
    {
        $method = $request->getMethod();
        
        // Only verify for state-changing methods
        if (!in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return true;
        }
        
        $params = $request->getParams();
        $token = $params['csrf_token'] ?? '';
        
        if (!Csrf::verifyToken($token)) {
            http_response_code(403);
            throw new \Exception('CSRF token validation failed');
        }
        
        return true;
    }
}

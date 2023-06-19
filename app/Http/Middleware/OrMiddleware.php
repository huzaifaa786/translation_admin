<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class OrMiddleware extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('api')->check() || $this->auth->guard('vendor_api')->check()) {
            return $this->auth->shouldUse('api');
        }

        parent::authenticate($request, $guards);
    }
}

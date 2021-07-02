<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)  //인증이 안되어 있으면 로그인 페이지로 이동
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

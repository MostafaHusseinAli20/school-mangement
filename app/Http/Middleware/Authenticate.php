<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            } elseif (Request::is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            } elseif (Request::is(app()->getLocale() . '/parent/dashboard')) {
                return route('selection');
            } else {
                return route('selection');
            }
        }
    }
}

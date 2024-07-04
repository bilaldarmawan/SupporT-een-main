<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        Log::info('Middleware Authenticate: User not authenticated', ['url' => $request->url()]);

        return $request->expectsJson() ? null : route('login');
    }
}

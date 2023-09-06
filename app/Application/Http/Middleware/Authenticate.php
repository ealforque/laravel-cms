<?php

namespace App\Application\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // @codeCoverageIgnoreStart
        abort(response()->json('Unauthorized', JsonResponse::HTTP_UNAUTHORIZED));
        // @codeCoverageIgnoreEnd
    }
}

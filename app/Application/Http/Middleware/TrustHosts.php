<?php

namespace App\Application\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        // @codeCoverageIgnoreStart
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
        // @codeCoverageIgnoreEnd
    }
}

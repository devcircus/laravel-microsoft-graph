<?php

namespace PerfectOblivion\MsGraph;

use Closure;
use PerfectOblivion\MsGraph\Facades\MsGraphAdmin;

class MsGraphAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (MsGraphAdmin::getTokenData() === null) {
            return MsGraphAdmin::connect();
        }

        return $next($request);
    }
}

<?php

namespace MailLight\Http\Middleware;

use Closure;

class PreventWebAccessOnServiceNode
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
        if(config('app.distributed.service'))
        {
            abort(404);
        }
        return $next($request);
    }
}

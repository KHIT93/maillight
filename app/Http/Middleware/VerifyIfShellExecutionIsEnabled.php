<?php

namespace MailLight\Http\Middleware;

use Closure;
use MailLight\Exceptions\MailLight\MissingRequirement;

class VerifyIfShellExecutionIsEnabled
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
        if(!function_exists('exec'))
        {
            throw new MissingRequirement("MailLight requires access to the 'exec' function in PHP. Please make sure that this function is available and not listed on the disabled_function directive of your php.ini file ");
        }
        if(!function_exists('shell_exec'))
        {
            throw new MissingRequirement("MailLight requires access to the 'shell_exec' function in PHP. Please make sure that this function is available and not listed on the disabled_function directive of your php.ini file ");
        }
        return $next($request);
    }
}

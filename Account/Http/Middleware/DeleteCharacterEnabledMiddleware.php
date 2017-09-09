<?php

namespace Bitaac\Account\Http\Middleware;

use Closure;

class DeleteCharacterEnabledMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! config('bitaac.account.delete-character-enabled', true)) {
            return redirect()->route('account');
        }

        return $next($request);
    }
}

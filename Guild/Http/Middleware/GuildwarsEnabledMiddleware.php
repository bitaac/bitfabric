<?php

namespace Bitaac\Guild\Http\Middleware;

use Closure;

class GuildwarsEnabledMiddleware
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
        if (! config('bitaac.guild.wars-enabled', true)) {
            return redirect()->route('guilds');
        }

        return $next($request);
    }
}

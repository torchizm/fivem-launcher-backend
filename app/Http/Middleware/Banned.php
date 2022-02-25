<?php

namespace App\Http\Middleware;

use Closure;
use App\Player;

class Banned
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
        // $player = Player::where('uid', $request->uid)->firstOrFail();
        // if(!empty($player->bans()))
        return $next($request);
    }
}

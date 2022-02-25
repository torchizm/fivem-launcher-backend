<?php

namespace App\Http\Middleware;

use Closure;
use App\Player;

class ApiToken
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
        $auth = $request->header('Authorization');
        if ($auth) {
            $token = str_replace('Bearer ', '', $auth);

            if (!$token) {
                return response()->json([
                    'message' => 'No Bearer Token!'
                ], 401);
            }

            $player = Player::where('api_token', $token)->first();
            if (!$player) {
                return response()->json([
                    'message' => 'Invalid Bearer Token!'
                ], 401);
            }

            return $next($request);
        }

        return response()->json([
            'message' => 'Not a valid Bearer Token!'
        ], 401);
    }
}

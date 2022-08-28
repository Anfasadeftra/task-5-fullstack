<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $api_keys = array('44b48f2305bf2680', 'a40d97bfc2ab0e56');

        if ($request->header('Authorization')) {
            $api_key = $request->header('Authorization');

            // check token
            if (in_array($api_key, $api_keys)) {
                return $next($request);
            } else {
                return response()->json([
                    'results' => 'API key is not valid',
                ]);
            }
        }

        return response()->json([
            'results' => 'Authorization failed',
        ]);
    }
}

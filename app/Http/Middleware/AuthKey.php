<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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

        $medex_app_key = config('app.medex_app_key');
        $header_app_key = $request->header('MEDEX-APP-KEY'); // on header() word separator must to be "-".
        // return response()->json(['hd' => $request->header()]); // you can check that MEDEX_APP_KEY is not come
        if ($medex_app_key !== $header_app_key) {
            return response()->json(['message' => 'App key not found.'], 401);
        }

        return $next($request);
    }
}

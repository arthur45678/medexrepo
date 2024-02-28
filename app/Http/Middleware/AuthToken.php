<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class AuthToken
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'auth_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $auth_token = $request->auth_token;
        $request_user_id = $request->user_id;

        $request_user = User::find($request_user_id);
        $auth_token_decrypt = '';
        try {
            $auth_token_decrypt = decrypt($auth_token);
        } catch (DecryptException $e) {
            return response()->json(['message' => 'Auth token not valid 1.'], 401);
        }

        if ($request_user->username !== $auth_token_decrypt) {
            return response()->json(['message' => 'Auth token not found 2.'], 401);
        }
        return $next($request);
    }
}

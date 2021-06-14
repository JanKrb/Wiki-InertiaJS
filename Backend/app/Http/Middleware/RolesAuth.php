<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolesAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next, string $permissions)
    {
        $permissions_exploded = explode('|', $permissions);

        foreach ($permissions_exploded as $permission) {
            if (!$request->user()->hasPermission($permission)) {
                $response = [
                    'success' => false,
                    'data'    => $permission,
                    'message' => "Missing permission to access.",
                ];

                return response()->json($response, 401);
            }
        }

        return $next($request);
    }
}

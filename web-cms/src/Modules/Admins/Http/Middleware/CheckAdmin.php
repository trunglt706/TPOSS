<?php

namespace Modules\Admins\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Admins\Entities\Admins;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->status == Admins::STATUS_ACTIVE && !is_null($user->deleted_at) && (is_null($user->expired_date) || $user->expired_date >= date('Y-m-d'))) {
            return $next($request);
        }
        if ($request->expectsJson()) {
            abort(response()->json([
                'status' => 403,
                'message' => __('access_denied')
            ], 403));
        } else {
            return to_route('admin.login');
        }
    }
}

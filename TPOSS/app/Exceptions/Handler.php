<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $this->renderable(function (AuthenticationException $exception, Request $request) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => $exception->getMessage()], 401);
                }
                $guard = \Arr::get($exception->guards(), 0);
                switch ($guard) {
                    case 'api':
                        return response()->json(['status' => 0, 'data' => 'Không có quyền truy cập!']);
                    case 'admin':
                        $login = 'admin.login';
                    case 'user':
                    default:
                        $login = 'login';
                        break;
                }
                return redirect()->guest(route($login));
            });
        });
    }
}

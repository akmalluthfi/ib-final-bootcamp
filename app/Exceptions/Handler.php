<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        if(request()->expectsJson() && request()->is('api/*')){
            $this->renderable(function (TokenBlacklistedException $e, $request){
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            });

            $this->renderable(function (AuthenticationException $e, $request){
                return response()->json([
                    'message' => $e->getMessage()
                ], 401);
            });

            $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
                return response()->json([
                    'message' => 'Method Not Allowed'
                ], 405);
            });

            $this->renderable(function (NotFoundHttpException $e, $request) {
                return response()->json([
                    'message' => 'Resource Not Found',
                ], 404);
            });

            $this->renderable(function (ValidationException $e, $request) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $e->errors()
                ], 422);
            });
 
            // handle exception when embedded/nested document not found using firstOrFail
            $this->renderable(function (ItemNotFoundException $e, $request) {
                throw new NotFoundHttpException;
            });

            $this->renderable(function (AccessDeniedException $e) {
                return response()->json([
                    'message' => 'you are not allowed to perform this action'
                ], 401);
            });
        }

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

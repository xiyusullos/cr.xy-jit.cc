<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

// use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // dd(get_class$e));
        return parent::render($request, $e);
        if ($request->wantsJson()) {
            if ($e instanceof ValidationException) {
                // Unprocessable Entity
                return $this->transform(
                    422,
                    'RQ1022',
                    '请求实体格式错误',
                    $e->validator->getMessageBag()->toArray()
                );
            }
            elseif ($e instanceof ForbiddenException) {
                // Forbidden
                return $this->transform(403, 'RQ1003', '请求被拒绝', $e->getMessage());
            }
            elseif ($e instanceof JWTTokenException) {
                // JWT token is error
                return $this->transform(403, 'RQ1003', '请求被拒绝',
                    $e->getMessage());
            }
        }

        return parent::render($request, $e);
    }

    protected function transform($status, $code, $title, $detail)
    {
        return response()->json([
            'error' => [
                'status' => $status,
                'code'   => $code,
                'title'  => $title,
                'detail' => $detail
            ]
        ], $status)
            ->header('Content-Type', env('API_CONTENT_TYPE'))
            ->header('X-Api-Version', env('API_VERSION'))
            ->header('X-Status', 'ERROR');
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}

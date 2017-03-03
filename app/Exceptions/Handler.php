<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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
*@return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);

        $errMsg = $e->getMessage();
        // $error = [
        //     'detail' => $errMsg
        // ];

        if ($e instanceof InvalidCredentialException) {
            return $this->transform(
                401,
                'AT1001',
                '认证失败',
                $errMsg
            );
        } elseif ($e instanceof UnsupportedMediaTypeHttpException) {
            return $this->transform(
                415,
                'RQ1015',
                'Content-Type格式错误',
                $errMsg
            );
        } elseif ($e instanceof NotAcceptableHttpException) {
            return $this->transform(
                406,
                'RQ1006',
                'Accept格式错误',
                $errMsg
            );
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return $this->transform(
                405,
                'RQ1005',
                'HTTP请求方法错误',
                '不存在该请求方式，可通过OPTION请求方式查看允许的请求方法'
            );
        } elseif ($e instanceof TokenExpiredException) {
            return $this->transform(
                401,
                'TK1001',
                'token错误',
                'token已过期'
            );
        } elseif ($e instanceof TokenNotProvidedException) {
            return $this->transform(
                400,
                'TK1004',
                'token错误',
                '尚未提供token'
            );
        } elseif ($e instanceof JWTException) {
            return $this->transform(
                400,
                'TK1000',
                'token错误',
                'token不正确'
            );
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->transform(
                404,
                'RQ1004',
                '实体不存在',
                $errMsg
            );
        } elseif ($e instanceof ValidationException) {
            return $this->transform(
                422,
                'RQ1022',
                '请求实体格式错误',
                $errMsg
            );
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->transform(
                404,
                'RT1004',
                '路由错误',
                '该路由不存在，检查请求方法和请求地址是否正确'
            );
        } elseif ($e instanceof AccessDeniedHttpException) {
            return $this->transform(
                403,
                'RQ1003',
                '请求被拒绝',
                $errMsg
            );
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

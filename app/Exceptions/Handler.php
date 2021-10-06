<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Responses\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\UnauthorizedException;
use Exception;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }

    public function render($request, Throwable $exception)
    {

        if ($request->wantsJson()) {
            return $this->handleApiException($request, $exception);

        }

        return parent::render($request, $exception);
    }

    private function handleApiException($request, $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return $this->customApiResponse($exception, 400);
        }

        if ($exception instanceof UnauthorizedException) {
            return $this->customApiResponse($exception, 403);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception, $customStatusCode = null)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = ($customStatusCode != null) ? $customStatusCode : 500;
        }

        $response = [];

        $message = method_exists($exception, 'getMessage') ? $exception->getMessage() : null;
        if ($message == null) {
            $message = (isset($exception->original['message'])) ? $exception->original['message'] : null;
        }


        switch ($statusCode) {
            case 400:
                $response['message'] = $message ??  'Bad Request';
                $response['errors'] = $exception->errors() ?? [];
                break;
            case 401:
                $response['message'] = $message ?? 'Unauthorized';
                break;
            case 403:
                $response['message'] = $message ?? 'Forbidden';
                break;
            case 404:
                $response['message'] = $message ?? 'Not Found';
                break;
            case 405:
                $response['message'] = $message ?? 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $message ?? "Unprocessed Entity";
                $response['errors'] = $exception->original['errors'] ?? [];
                break;
            default:
                if (config('app.debug')) {
                    $response['message'] = $message ?? 'Whoops, looks like something went wrong';
                } else {
                    $response['message'] = 'Whoops, looks like something went wrong';
                }
                break;
        }

        if (config('app.debug')) {
            $response['trace']  = (method_exists($exception, 'getTrace')) ? $exception->getTrace() : null;
            $response['code']   = (method_exists($exception, 'getCode')) ? $exception->getCode() : null;
        }

        return JsonResponse::error($statusCode, $response['errors'] ?? $response['message']);
    }
}

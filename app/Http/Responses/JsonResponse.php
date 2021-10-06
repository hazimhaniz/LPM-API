<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse as BaseJsonResponse;
use Illuminate\Support\Facades\Log;

class JsonResponse
{
    const HTTP_OK                           = 200;
    const HTTP_BAD_REQUEST                  = 400;
    const HTTP_UNAUTHORIZED                 = 401;
    const HTTP_FORBIDDEN                    = 403;
    const HTTP_NOT_FOUND                    = 404;
    const HTTP_UNPROCESSABLE_ENTITY         = 422;
    const HTTP_INTERNAL_SERVER_ERROR        = 500;

    const TIMEZONE                          = 'UTC';

    protected static $message = [
        self::HTTP_OK                       => 'OK',
        self::HTTP_BAD_REQUEST              => 'Bad request',
        self::HTTP_UNAUTHORIZED             => 'Unauthorized',
        self::HTTP_FORBIDDEN                => 'Forbidden',
        self::HTTP_NOT_FOUND                => 'Not found',
        self::HTTP_UNPROCESSABLE_ENTITY     => 'Unprocessable entity',
        self::HTTP_INTERNAL_SERVER_ERROR    => 'Internal server error',
    ];

    public static function success($data = null): BaseJsonResponse
    {
        return self::buildResponse($data, self::HTTP_OK);
    }

    public static function error($statusCode = 404, $errors = null, $data = null): BaseJsonResponse
    {
        Log::error(response()->json($errors, $statusCode, [], JSON_PRESERVE_ZERO_FRACTION));

        return self::buildResponse($data, $statusCode, $errors ?: self::$message[$statusCode]);
    }

    private static function buildResponse($data = null, $statusCode = 404, $errors = null): BaseJsonResponse
    {
        $response['success']    = $statusCode === self::HTTP_OK ? true : false;
        $response['data']       = $data;
        $response['errors']     = $errors;
        $response['code']       = $statusCode;

        return response()->json($response, $statusCode, [], JSON_PRESERVE_ZERO_FRACTION);
    }

}

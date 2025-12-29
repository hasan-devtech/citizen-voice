<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = [], $message = 'Success', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }
    public static function error($message = 'Error', $status = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }

    public static function paginate($code = 200, $msg = "ok", $data = null)
    {
        $response = [
            'message' => $msg,
            'data' => $data->response()->getData()->data,
            'links' => $data->response()->getData()->links,
            'meta' => $data->response()->getData()->meta
        ];
        return response()->json($response, $code);
    }
}

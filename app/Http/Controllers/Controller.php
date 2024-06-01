<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function sendError($message = [], $code = 422)
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => $message
            ]
        ], $code);
    }


    public function sendSuccess($data = [], $code = 200)
    {
        return response()->json([
            "meta" => [
                "success" => true,
                "errors" => [],
            ],
            "data" => $data,
        ], $code);
    }

}

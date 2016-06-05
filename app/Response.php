<?php

namespace App;

use Illuminate\Http\JsonResponse;

class Response extends JsonResponse
{
    public function __construct($code = 200, $message = 'OK', $data = null, $errors = null)
    {
        parent::__construct();
        $response = [
        "status" => [
          "code" => $code,
          "message" => $message
        ],
        "data" => $data,
        "errors" => $errors
        ];
        return $this->setStatusCode($code, $message)->setData($response);
    }
}

<?php

namespace App\Utils;

use App\Exceptions\ClientError;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ErrorHandler
{
    public function handle($error)
    {
        if ($error instanceof ClientError) {
            return [
                "data" => [
                    "status" => "fail",
                    "message" => $error->getMessage(),
                ],
                "code" => $error->getCode(),
            ];
        }

        if ($error instanceof ValidationException) {
            $errors = $error->validator->errors();

            return [
                "data" => [
                    "status" => "fail",
                    "message" => 'Validation Error' . $errors->toArray(),
                ],
                "code" => 400,
            ];
        }

        Log::error($error);

        return [
            "data" => [
                "status" => "error",
                "message" => "Terjadi kesalahan pada server kami",
            ],
            "code" => 500,
        ];
    }
}

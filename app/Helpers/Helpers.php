<?php

namespace App\Helpers;

use App\Exceptions\APIException;
use Exception;
use Illuminate\Support\Facades\Log;

class Helpers
{
    public static function generateResponse($status = 0, $code = 0, $message = "", $data = null, $metadata = null){
        $response =  array(
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'metadata' => $metadata
        );

        if (empty($metadata)) {
            unset($response['metadata']);
        }

        return $response;
    }

    public static function getException(Exception $e){
        if ($e instanceof APIException) {
            $dataResponse = $e->getException();
        } else {
            Log::error($e);
            $dataResponse = self::generateResponse(0, 500, 'Unexpected Error', null);
        }

        return $dataResponse;
    }
}

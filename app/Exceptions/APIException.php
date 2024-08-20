<?php

namespace App\Exceptions;

use App\Helpers\Helpers;
use Exception;

class APIException extends Exception
{
    private $apiStatus;
    private $apiCode;
    private $apiMessage;
    private $apiData;

    public function __construct(int $status = 0, int $code = 1001, $messages = 'Unexpected Error', $data = null)
    {
        $this->apiStatus = $status;
        $this->apiCode = $code;
        $this->apiMessage = $messages;
        $this->apiData = $data;
    }

    public function getException()
    {
        return Helpers::generateResponse($this->apiStatus, $this->apiCode, $this->apiMessage, $this->apiData);
    }
}

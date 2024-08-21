<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class APIConnection
{
    public static function getResponse($endpoint, $method){
        $request = Request::create($endpoint, $method);
        $response = Route::dispatch($request);
        $responseBody = json_decode($response->getContent(), true);

        return $responseBody;
    }
}

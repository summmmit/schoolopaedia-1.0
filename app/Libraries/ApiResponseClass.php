<?php

namespace App\Libraries;

use Illuminate\Http\Response;

class ApiResponseClass {

    /**
     * @param array $result
     * @param array $request
     * @return json ( status, result, request)
     */
    public static function  successResponse($result = array(), $request = array()){
        $successResponse = [
            'status'   => 'success',
            'result'   =>  $result,
            'request'  =>  $request
        ];
        return response()->json($successResponse);
    }

    /**
     * @param $message
     * @param $description
     * @param array $request
     * @return  json ( status, result, request)
     */
    public static function errorResponse($description, $request = array(), $result = array()){
        
        $errorResponse = [
            'status'    => 'failed',
            'error'     => [
                'result'         => $result,
                'error_description'   =>  $description
            ],
            'request'   => $request
        ];
        return response()->json($errorResponse);
    }
}

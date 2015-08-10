<?php

namespace App\Libraries;

use Illuminate\Http\Response;

class ApiResponseClass {
    
    public static function  successResponse($result = array(), $request = array()){
        $successResponse = [
            'status'   => 'success',
            'result'   =>  $result,
            'request'  =>  $request
        ];
        return response()->json($successResponse);
    }
    
    public static function errorResponse($message, $description, $request = array()){
        
        $errorResponse = [
            'status'    => 'failed',
            'error'     => [
                'message'      =>  $message,
                'description'  =>  $description
            ],
            'request'   => $request
        ];
        return response()->json($errorResponse);
    }
}

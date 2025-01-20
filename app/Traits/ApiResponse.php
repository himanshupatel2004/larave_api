<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

########## API Response Traits #################


trait ApiResponse
{
    ############ Success ##################
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    ############ Error ##################
    protected function error($data, string $message = null, int $code = 400)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
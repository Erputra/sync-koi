<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Send a success response
     */
    protected function successResponse($data, $message = "Success", $status = 200, $rows = 0)
    {
        return response()->json([
            'JSONResult' => true,
            'JSONMessage' => $message,
            'JSONRows' => $rows,
            'JSONValue' => $data
        ], $status);
    }

    /**
     * Send an error response
     */
    protected function errorResponse($message = "Error", $status = 400, $data = null, $rows = 0)
    {
        return response()->json([
            'JSONResult' => false,
            'JSONMessage' => $message,
            'JSONRows' => $rows,
            'JSONValue' => $data
        ], $status);
    }

    /**
     * Send a validation error response
     */
    protected function validationErrorResponse($errors, $message = "Validation errors", $status = 422, $rows = 0)
    {
        return response()->json([
            'JSONResult' => false,
            'JSONMessage' => $message,
            'JSONRows' => $rows,
            'JSONValue' => []
        ], $status);
    }
}

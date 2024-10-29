<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Send a success response
     */
    protected function successResponse($data, $message = "Success", $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Send an error response
     */
    protected function errorResponse($message = "Error", $status = 400, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Send a validation error response
     */
    protected function validationErrorResponse($errors, $message = "Validation errors", $status = 422)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}

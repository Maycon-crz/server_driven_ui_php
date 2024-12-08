<?php
abstract class BaseController {
    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function errorResponse($message, $statusCode = 400) {
        $this->jsonResponse([
            'status' => 'error',
            'message' => $message
        ], $statusCode);
    }

    protected function successResponse($data, $message = 'Success', $statusCode = 200) {
        $this->jsonResponse([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
} 
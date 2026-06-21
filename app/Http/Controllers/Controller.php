<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function __construct()
    {
    }

    protected function jsonResponse($data = null, string $message = '', int $status = 200)
    {
        return response()->json([
            'success' => $status >= 200 && $status < 300,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    protected function backWithMessage(string $message, string $level = 'success')
    {
        session()->flash($level, $message);
        return back();
    }
}

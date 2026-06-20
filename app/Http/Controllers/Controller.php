<?php

namespace App\Http\Controllers;

/**
 * Base Controller
 *
 * All application controllers should extend this class.  It provides a
 * convenient place to define shared functionality (e.g., middleware
 * registration, helper methods, common response utilities) that can be
 * reused across every concrete controller.
 *
 * By declaring the class as `abstract` we make sure nobody can
 * accidentally instantiate it directly – only child classes that extend it
 * are meant to be resolved by the service container.
 */
abstract class Controller
{
    /**
     * Constructor.
     *
     * Laravel automatically resolves controller dependencies via the
     * service container.  If you need to register default middleware for
     * *all* controllers, you can do it here by calling `$this->middleware()`.
     *
     * Example:
     *   public function __construct()
     *   {
     *       $this->middleware('auth')->except(['index', 'show']);
     *   }
     *
     * Leaving the constructor empty keeps the base class lightweight.
     */
    public function __construct()
    {
        // No default behaviour – child controllers may add their own middleware.
    }

    /**
     * Helper: Return a JSON response with a standard structure.
     *
     * Many APIs share a common envelope (e.g., `success`, `data`, `message`).
     * Child controllers can call `$this->jsonResponse($data, $message, $status)`.
     *
     * @param  mixed   $data      The payload to be JSON‑encoded.
     * @param  string  $message   Optional human‑readable message.
     * @param  int     $status    HTTP status code (default 200).
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data = null, string $message = '', int $status = 200)
    {
        $payload = [
            'success' => $status >= 200 && $status < 300,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($payload, $status);
    }

    /**
     * Helper: Redirect back with an optional flash message.
     *
     * Usage in child controllers:
     *   return $this->backWithMessage('Record saved successfully.');
     *
     * @param  string $message   Message to flash to the session.
     * @param  string $level     Flash level (e.g., 'success', 'error').
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function backWithMessage(string $message, string $level = 'success')
    {
        session()->flash($level, $message);
        return back();
    }
}
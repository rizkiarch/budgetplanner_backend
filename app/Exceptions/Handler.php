<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

public function register()
{
    $this->renderable(function (ValidationException $e, $request) {
        return response()->json([
            'message' => 'Validation Error',
            'errors' => $e->errors(),
        ], 422);
    });

    $this->renderable(function (ModelNotFoundException $e, $request) {
        return response()->json([
            'message' => 'Resource not found'
        ], 404);
    });
}

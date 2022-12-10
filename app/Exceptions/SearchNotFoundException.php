<?php

namespace App\Exceptions;

use Exception;

class SearchNotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
        ], 404);
    }
}

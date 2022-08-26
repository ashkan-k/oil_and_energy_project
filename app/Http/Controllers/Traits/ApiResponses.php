<?php

namespace App\Http\Controllers\Traits;

trait ApiResponses
{
    protected function ApiSuccessResponse($message = [],$code=200)
    {
        return response($message,$code);
    }
}

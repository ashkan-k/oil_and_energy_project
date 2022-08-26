<?php

namespace App\Http\Controllers\Traits;

trait Responses
{
    protected function SuccessRedirect($message, $route, $errors = [], $params=[])
    {
        \Request::session()->flash('message', $message);
        return redirect(route($route,$params))->withErrors($errors);
    }
}

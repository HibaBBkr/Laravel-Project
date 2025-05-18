<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;

class LoginViewResponse implements LoginViewResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Replace 'auth.login' with the actual path to your login view
        // if it's different.
        return view('auth.login');
    }
}
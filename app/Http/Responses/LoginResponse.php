<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = auth()->user()->isAdmin() 
            ? Fortify::redirects('admin_login') 
            : Fortify::redirects('login');

        return redirect()->intended($home);
    }
}
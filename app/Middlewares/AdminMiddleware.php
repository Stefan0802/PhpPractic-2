<?php

namespace Middlewares;

use Src\Auth\Auth;
use Model\User;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {

        if(User::isAdmin()){
            app()->route->redirect('/logout');
        }

    }
}
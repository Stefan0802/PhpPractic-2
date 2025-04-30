<?php

namespace Middlewares;

use Src\Auth\Auth;
use Model\User;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        $user= Auth::user();

        if($user->IdRole == 1){
            app()->route->redirect('/hello');
        }

    }
}
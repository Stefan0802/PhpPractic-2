<?php

namespace Controller;

use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class User
{

// регистрация
    public function signup(Request $request): string
    {
        if($error = \Model\User::createUser($request))
        {
            return new View('site.signup',
                ['message' => json_encode($error, JSON_UNESCAPED_UNICODE)]);
        }
        return new View('site.signup');
    }

//авторизация
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    //выход
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }



}




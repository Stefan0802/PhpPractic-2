<?php

namespace Controller;



use Model\User;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Admin
{

    // восправизведение пользователей

    public function admin(Request $request): string
    {

        $users = \Model\Department::search($request);

        return (new View())->render('site.admin', ['users' => $users, 'request' => $request]);
    }

    //создание пользователя админом
    public function create_user(Request $request): string
    {

        if($error = \Model\User::createAdminUser($request))
        {
            return new View('site.site.createUser', ['message' => json_encode($error->errors(), JSON_UNESCAPED_UNICODE)]);
        }


        return new View('site.createUser');
    }




}
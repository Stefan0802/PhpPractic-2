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


        $query = User::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('lastName', 'LIKE', "%{$search}%")
                    ->orWhere('login', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->get();

        return (new View())->render('site.admin', ['users' => $users, 'request' => $request]);
    }

    //создание пользователя админом
    public function create_user(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required', 'password'],
                'idRole' => ['required'],
                'avatar' => ['avatar:user,avatar'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);


            if($validator->fails()){
                return new View('site.createUser',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }



            if ($request->avatar) {
                $user = new User();
                $avatarPath = $user->uploadAvatar($request->file('avatar'));

                if ($avatarPath) {
                    $data['avatar'] = $avatarPath;
                    $user->update(['avatar'=> $avatarPath]);
                }
            }

            User::create($data);

            app()->route->redirect('/admin');
        }
        return new View('site.createUser');
    }




}
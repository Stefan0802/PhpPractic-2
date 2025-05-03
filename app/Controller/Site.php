<?php

namespace Controller;

use Model\Telephone;
use Model\Room;
use Model\RoomType;
use Model\Department;
use Model\DepartmentType;
use Model\Post;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'Главная страница в разработке начальника ']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'idRole' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }



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

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

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

    public function create_user(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'idRole' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                     ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                }

            User::create($request->all());
            app()->route->redirect('/admin');
        }
        return new View('site.createUser');
    }

    public function view_department(Request $request): string
    {

        $query = Department::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%");

            });
        }

        $departments = $query->get();

        $types = DepartmentType::all();

        // массив "id => name"
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[$type->id] = $type->name;
        }

        return (new View())->render('site.department', [
            'departments' => $departments,
            'typeNames' => $typeNames,
            'types' => $types
        ]);
    }

    public function create_department(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.create_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

                Department::create($request->all());
                app()->route->redirect('/department');
        }else{
            $types = DepartmentType::all();
        }
        return (new View())->render('site.create_department', ['types' => $types]);
    }

    public function create_type_department(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.type_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            DepartmentType::create($request->all());
            app()->route->redirect('/department/TypeDepartment');
        }else{
            $types = DepartmentType::all();
            return (new View())->render('site.type_department', ['types' => $types]);
        }
        return new View('site.type_department');
    }


    public function view_room(Request $request): string
    {


        $query = Room::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%");

            });
        }

        $rooms = $query->get();


        $types = RoomType::all();
        $department = Department::all();

        $depNames = [];
        foreach ($department as $dep) {
            $depNames[$dep->id] = $dep->name;
        }

        // массив "id => name"
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[$type->id] = $type->name;
        }

        return (new View())->render('site.room', [
            'rooms' => $rooms,
            'typeNames' => $typeNames,
            'types' => $types,
            'depNames' => $depNames
        ]);
    }

    public function create_room(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.create_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            Room::create($request->all());
            app()->route->redirect('/room');
        }else{
            $typesRooms = RoomType::all();
            $typesDepartments = Department::all();
        }
        return (new View())->render('site.create_room', ['typesRooms' => $typesRooms, 'typesDepartments' => $typesDepartments]);
    }

    public function create_type_room(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.type_room',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            RoomType::create($request->all());
            app()->route->redirect('/room/TypeRoom');
        }else{
            $types = RoomType::all();
            return (new View())->render('site.type_room', ['types' => $types]);
        }
        return new View('site.type_room');
    }


    public function view_phone(Request $request): string
    {


        $query = Telephone::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('number', 'LIKE', "%{$search}%");
            });
        }

        $phones = $query->get();

        return (new View())->render('site.phone', ['phones' => $phones, 'request' => $request]);
    }


    public function create_phone(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'number' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.create_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            Telephone::create($request->all());
            app()->route->redirect('/phone');
        }else{
            $rooms = Room::all();
        }
        return (new View())->render('site.create_phone', ['rooms' => $rooms]);
    }

}
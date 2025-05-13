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

    public function hello(): string
    {
        return new View('site.hello', []); // 'message' => 'Главная страница в разработке начальника '
    }


}
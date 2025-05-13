<?php

namespace Controller;

use Illuminate\Database\Eloquent\Model;
use Model\DepartmentType;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Department
{
    public function view_department(Request $request): string
    {


        $departments = \Model\Department::search($request);
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

        if($error = \Model\Department::createDepart($request))
        {
            $types = DepartmentType::all();
            return new View('site.create_department', ['types'=> $types, 'message' => json_encode($error, JSON_UNESCAPED_UNICODE)]);
        }

        $types = DepartmentType::all();

        return (new View())->render('site.create_department', ['types' => $types]);
    }

    public function create_type_department(Request $request): string
    {

        if($error = \Model\Department::createDepart($request))
        {
            $types = DepartmentType::all();
            return new View('site.type_department',
                ['types' => $types,'message' => json_encode($error, JSON_UNESCAPED_UNICODE)]);
        }

            $types = DepartmentType::all();
            return (new View())->render('site.type_department', ['types' => $types]);
    }
}
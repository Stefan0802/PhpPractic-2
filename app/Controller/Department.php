<?php

namespace Controller;

use Model\DepartmentType;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Department
{
    public function view_department(Request $request): string
    {

        $query = \Model\Department::query();

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
}
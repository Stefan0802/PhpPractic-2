<?php

namespace Controller;



use Model\Department;
use Model\RoomType;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Room
{



    public function view_room(Request $request): string
    {


        $query = \Model\Room::query();

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


}
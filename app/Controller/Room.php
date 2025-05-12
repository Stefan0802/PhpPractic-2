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

        $rooms = \Model\Room::search($request);
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
        if($error = \Model\Room::createRoom($request))
        {
            return new View('site.create_department',
                ['message' => json_encode($error->errors(), JSON_UNESCAPED_UNICODE)]);
        }

            $typesRooms = RoomType::all();
            $typesDepartments = Department::all();

        return (new View())->render('site.create_room', ['typesRooms' => $typesRooms, 'typesDepartments' => $typesDepartments]);
    }

    public function create_type_room(Request $request): string
    {

        if($error = \Model\Room::createTypeRoom($request))
        {
            return new View('site.create_department',
                ['message' => json_encode($error->errors(), JSON_UNESCAPED_UNICODE)]);
        }

        $types = RoomType::all();
        return (new View())->render('site.type_room', ['types' => $types]);


    }


}
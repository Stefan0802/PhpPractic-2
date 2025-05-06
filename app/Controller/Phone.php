<?php

namespace Controller;


use Model\Room;
use Model\Telephone;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class phone
{


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
        $rooms = 0;
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'number' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.type_room',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            Telephone::create($request->all());
            app()->route->redirect('/phone');
        } else {
            $rooms = Room::all();
        }
        return (new View())->render('site.create_phone', ['rooms' => $rooms]);
    }


}
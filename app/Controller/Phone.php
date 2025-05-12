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
        $phones = \Model\Telephone::search($request);
        return (new View())->render('site.phone', ['phones' => $phones, 'request' => $request]);
    }




    public function create_phone(Request $request): string
    {

        if($error = \Model\Telephone::createPhone($request))
        {
            return new View('site.type_room',
                ['message' => json_encode($error->errors(), JSON_UNESCAPED_UNICODE)]);
        }


            $rooms = Room::all();

        return (new View())->render('site.create_phone', ['rooms' => $rooms]);
    }


}
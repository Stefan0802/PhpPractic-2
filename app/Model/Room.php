<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Validator\Validator;
use Src\View;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'idDepartment',
        'idRoomType',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'idDepartment');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'idRoomType');
    }


    public static function search($request)
    {
        $query = \Model\Room::query();


        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%");

            });
        }

        return $query->get();
    }


    public static function createRoom($request)
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return $validator->errors();
            }

            \Model\Room::create($request->all());

            app()->route->redirect('/room');
        }
    }


    public static function createTypeRoom($request)
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return $validator->errors();
            }

            RoomType::create($request->all());
            app()->route->redirect('/room/TypeRoom');
        }
    }
}
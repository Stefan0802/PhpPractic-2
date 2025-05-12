<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Validator\Validator;
use Src\View;

class Telephone extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'number',
        'idRoom',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'idRoom');
    }

    public static function search($request)
    {
        $query = Telephone::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('number', 'LIKE', "%{$search}%");
            });
        }

        return $query->get();
    }


    public static function createPhone($request)
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'number' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return $validator->errors();
            }

            Telephone::create($request->all());
            app()->route->redirect('/phone');
        }
    }
}
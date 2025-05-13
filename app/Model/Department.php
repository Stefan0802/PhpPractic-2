<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Validator\Validator;
use Src\View;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'idDepartmentType',
    ];

    public function type()
    {
        return $this->belongsTo(DepartmentType::class, 'idDepartmentType');
    }


    public static function search($request)
    {
        $query = \Model\Department::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%");

            });
        }

        return $query->get();
    }

    public static function createDepart($request)
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

            \Controller\Department::create($request->all());
            app()->route->redirect('/department');
        }
    }

}
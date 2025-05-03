<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'patronymic',
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
}
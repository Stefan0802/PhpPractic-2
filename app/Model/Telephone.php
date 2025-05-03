<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'idUser',
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
}
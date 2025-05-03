<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfSeparation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',

    ];



}
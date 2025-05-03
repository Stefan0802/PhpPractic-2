<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
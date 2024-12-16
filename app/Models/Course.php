<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
        'name',
        'title',
        'description',
        'price',
        'level',
        'instructor_id',
        'category_id',
        'sub_category_id',
        'duration',
        'resource',
        'prerequisite',
        'certificate',
        'image',
        'FOC'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //
    protected $fillable = [
        'course_id',
        'goal'
    ];
}

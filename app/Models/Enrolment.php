<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'enrol_code'
    ];
}

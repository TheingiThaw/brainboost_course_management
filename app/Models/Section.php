<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
        'course_id',
        'title',
        'description'
    ];

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'section_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    //
    protected $fillable = [
        'section_id',
        'name',
        'video',
        'description'
    ];

    public function sections(){
        return $this->belongsTo(Section::class, 'section_id');
    }
}

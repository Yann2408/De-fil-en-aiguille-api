<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person_measurement extends Model
{
    use HasFactory;

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'support');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

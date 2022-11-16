<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'support');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pattern()
    {
        return $this->belongsTo(Pattern::class);
    }

    public function tissus()
    {
        return $this->belongsToMany(Tissu::class);
    }

    public function person_measurement()
    {
        return $this->belongsTo(Person_measurement::class);
    }
}

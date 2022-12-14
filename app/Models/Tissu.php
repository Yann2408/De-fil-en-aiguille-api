<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tissu extends Model
{
    use HasFactory;

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'support');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tissu_type()
    {
        return $this->belongsTo(TissuType::class);
    }
}

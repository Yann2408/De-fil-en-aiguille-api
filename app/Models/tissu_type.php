<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tissu_type extends Model
{
    use HasFactory;

    public function tissus()
    {
        return $this->hasMany(Tissu::class);
    }
}

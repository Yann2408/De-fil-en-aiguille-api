<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fistname',
        'lastname',
        'email',
        'password',
        'is_superadmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function picture()
    {
        return $this->morphOne(Picture::class, 'support');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function to_buy_lists()
    {
        return $this->hasMany(To_buy_list::class);
    }

    public function patterns()
    {
        return $this->hasMany(Pattern::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function tissus()
    {
        return $this->hasMany(Tissu::class);
    }

    public function inspirations()
    {
        return $this->hasMany(Inspiration::class);
    }

    public function person_measurements()
    {
        return $this->hasMany(Person_measurement::class);
    }
}

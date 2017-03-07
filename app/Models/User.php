<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

/**
 * Class User
 */
class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        // 'remember_token'
    ];

    protected $guarded = [];

    public function getTokenAttribute()
    {
        return \JWTAuth::fromUser($this);
    }

    public function reservations()
    {
        return $this->hasMany(Classroom::class, 'id', 'classroom_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
        
}
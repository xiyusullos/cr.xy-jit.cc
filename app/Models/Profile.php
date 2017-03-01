<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 */
class Profile extends Model
{
    protected $table = 'profiles';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'age',
        'gender'
    ];

    protected $guarded = [];

        
}
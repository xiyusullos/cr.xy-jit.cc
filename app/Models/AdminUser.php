<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Administrator as Model;

/**
 * Class AdminUser
 */
class AdminUser extends Model
{
    protected $table = 'admin_users';

    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'name',
        'avatar',
        'remember_token'
    ];

    protected $guarded = [];

}
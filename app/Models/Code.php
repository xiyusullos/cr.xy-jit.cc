<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeleteModel as Model;
/**
 * Class Code
 */
class Code extends Model
{
    protected $table = 'code';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'code',
        'expiration',
    ];

    protected $guarded = [];

        
}
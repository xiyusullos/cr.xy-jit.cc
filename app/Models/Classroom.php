<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeleteModel as Model;
/**
 * Class Classroom
 */
class Classroom extends Model
{
    protected $table = 'classrooms';

    public $timestamps = true;

    protected $fillable = [
        'number',
        'name',
        'location',
        'square',
        'floor',
        'is_free',
        'building_name'
    ];

    protected $guarded = [];

        
}
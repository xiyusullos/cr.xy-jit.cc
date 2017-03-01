<?php

namespace App\Entities;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Classroom extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}

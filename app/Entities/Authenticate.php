<?php

namespace App\Entities;

// use Illuminate\Database\Eloquent\Model;
use App\Models\User as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Authenticate extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];
}

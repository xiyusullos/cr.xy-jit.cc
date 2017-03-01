<?php

namespace App\Entities;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Reservation extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}

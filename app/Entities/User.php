<?php

namespace App\Entities;

use App\Models\User as Model;
// use Illuminate\Foundation\Auth\User as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements Transformable
{
    use TransformableTrait;

}

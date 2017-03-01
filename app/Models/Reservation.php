<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeleteModel as Model;

/**
 * Class Reservation
 */
class Reservation extends Model
{
    protected $table = 'reservations';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'begin_time',
        'end_time'
    ];

    protected $guarded = [];

    public function admin_user()
    {
        // return $this->hasOne(AdminUser::class, 'id', 'user_id');
        return $this->belongsTo(AdminUser::class, 'user_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }
        
}
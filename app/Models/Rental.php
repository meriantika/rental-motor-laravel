<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'motor_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motor_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
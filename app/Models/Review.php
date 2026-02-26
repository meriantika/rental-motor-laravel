<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Letakkan kode protected $fillable di sini
    protected $fillable = ['rental_id', 'user_id', 'motor_id', 'rating', 'comment'];

    /**
     * Relasi ke model Motor
     */
    public function motor() {
        return $this->belongsTo(Motor::class);
    }

    /**
     * Relasi ke model User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
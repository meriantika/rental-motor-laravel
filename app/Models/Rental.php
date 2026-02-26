<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    /**
     * Daftar kolom yang boleh diisi (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'motor_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
    ];

    /**
     * Relasi ke model Motor.
     * Menghubungkan setiap data rental dengan informasi unit motornya.
     */
    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }

    /**
     * Relasi ke model User.
     * Menghubungkan data rental dengan akun user yang melakukan penyewaan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
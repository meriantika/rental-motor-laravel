<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     * Pastikan nama kolom di sini sama persis dengan yang ada di database.
     */
    protected $fillable = [
        'name',           
        'brand',          
        'type',           
        'cc',             
        'price_per_day',  
        'image_url',      
        'rating',         
        'is_available'    
    ];

    /**
     * Menetapkan nilai default untuk atribut tertentu.
     * Ini berguna agar saat kamu menyimpan data baru (store), 
     * rating otomatis mulai dari 0 dan motor langsung tersedia.
     */
    protected $attributes = [
        'rating' => 0,
        'is_available' => true,
    ];

    /**
     * Opsional: Casting tipe data.
     * Memastikan 'price_per_day' selalu dibaca sebagai angka (integer/float).
     */
    protected $casts = [
        'is_available' => 'boolean',
        'price_per_day' => 'integer',
        'cc' => 'integer',
        'rating' => 'decimal:1',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',           // Bukan nama_motor
        'brand',          
        'type',           
        'cc',             
        'price_per_day',  // Bukan harga_per_hari
        'image_url',      
        'rating',         
        'is_available'    
    ];
}
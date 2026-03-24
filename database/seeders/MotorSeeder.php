<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motor;

class MotorSeeder extends Seeder
{
    public function run(): void
    {
        Motor::create([
            'name' => 'Honda PCX 160',
            'brand_id' => 1,
            'cc' => 160,
            'type' => 'Matic',
            'price_per_day' => 120000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhigyVFWyr_Y2hcYyUx99ySe5OXbv3eUrvdA&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha NMAX',
            'brand_id' => 2,
            'cc' => 155,
            'type' => 'Matic',
            'price_per_day' => 130000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9cNsIBt1w6dVfsaMxgwkpbZ439zDSbF5xaA&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Honda Scoopy Prestige',
            'brand_id' => 1,
            'cc' => 110,
            'type' => 'Matic',
            'price_per_day' => 90000,
            'image_url' => 'https://www.olx.co.id/news/wp-content/uploads/2024/11/New-Honda-Scoopy-Prestige-White.jpg',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha Aerox',
            'brand_id' => 2,
            'cc' => 125,
            'type' => 'Matic',
            'price_per_day' => 120000,
            'image_url' => 'https://yamaha-motor.id/wp-content/uploads/2020/11/AEROX-Black-Grey-600x400.png',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha Mio M3',
            'brand_id' => 2,
            'cc' => 155,
            'type' => 'Matic',
            'price_per_day' => 80000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQme8RT0Pqz7SebyLjgTHaDLBP3v92toZUpVQ&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Honda Vario 160',
            'brand_id' => 1,
            'cc' => 160,
            'type' => 'Matic',
            'price_per_day' => 150000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKEFP8JpWmv8BTsDwKfpZF9cK0NF5bUcBWdA&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Honda Genio CBS-ISS',
            'brand_id' => 1,
            'cc' => 110,
            'type' => 'Matic',
            'price_per_day' => 115000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsbR2aiZTi2jXWTMQJskDMI1M2LDYewz5CJg&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha Grand Filano',
            'brand_id' => 2,
            'cc' => 125,
            'type' => 'Matic',
            'price_per_day' => 125000,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0Kp6VLPzz7__fB-Gbul9AFLdTrHN1Mr3U4Q&s',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Honda Beat Deluxe',
            'brand_id' => 1,
            'cc' => 110,
            'type' => 'Matic',
            'price_per_day' => 95000,
            'image_url' => 'https://portalmadura.com/wp-content/uploads/2023/08/Honda-Beat-Deluxe-2023_-Skutik-Irit-dengan-Fitur-Canggih.webp',
            'is_available' => true
        ]);
    }
}
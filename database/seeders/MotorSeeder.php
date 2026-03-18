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
            'image_url' => 'https://astra-honda.com/uploads/images/products/pcx160.png',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha NMAX',
            'brand_id' => 2,
            'cc' => 155,
            'type' => 'Matic',
            'price_per_day' => 130000,
            'image_url' => 'https://yamaha-motor.co.id/images/nmax.png',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Honda Scoopy',
            'brand_id' => 1,
            'cc' => 110,
            'type' => 'Matic',
            'price_per_day' => 90000,
            'image_url' => 'https://astra-honda.com/uploads/images/products/scoopy.png',
            'is_available' => true
        ]);

        Motor::create([
            'name' => 'Yamaha Aerox',
            'brand_id' => 2,
            'cc' => 155,
            'type' => 'Matic',
            'price_per_day' => 120000,
            'image_url' => 'https://yamaha-motor.co.id/images/aerox.png',
            'is_available' => true
        ]);
    }
}
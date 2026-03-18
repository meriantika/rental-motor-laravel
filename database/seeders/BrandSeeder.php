<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create(['name' => 'Honda']);
        Brand::create(['name' => 'Yamaha']);
        Brand::create(['name' => 'Suzuki']);
        Brand::create(['name' => 'Kawasaki']);
    }
}
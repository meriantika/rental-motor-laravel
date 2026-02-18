<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('motors', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Vario 160
        $table->string('brand');      // Honda / Yamaha
        $table->string('type');       // Matic / Sport / Manual
        $table->integer('cc');
        $table->integer('price_per_day');
        $table->string('image_url')->nullable();
        $table->text('rating')->nullable();
        $table->boolean('is_available')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};

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

            $table->string('name');

            $table->foreignId('brand_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('cc');

            $table->enum('type', ['Matic','Manual','Sport']);

            $table->integer('price_per_day');

            $table->string('image_url')->nullable();

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
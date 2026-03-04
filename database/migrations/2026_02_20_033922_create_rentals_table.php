<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('motor_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_days');
            $table->integer('total_price');

            // Kolom upload bukti pembayaran
            $table->string('payment_proof')->nullable();

            // Status rental
            $table->enum('status', [
                'pending',
                'waiting_verification',
                'confirmed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
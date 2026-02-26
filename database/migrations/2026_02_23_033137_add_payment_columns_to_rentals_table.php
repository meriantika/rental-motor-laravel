<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('rentals', function (Blueprint $table) {
        // Menambahkan kolom untuk menyimpan nama file gambar bukti bayar
        $table->string('payment_proof')->nullable()->after('total_price'); 
        
        // Menambahkan kolom status dengan pilihan tertentu
        $table->enum('status', ['pending', 'waiting_verification', 'confirmed', 'cancelled'])
              ->default('pending')
              ->after('payment_proof');
    });
}

public function down()
{
    Schema::table('rentals', function (Blueprint $table) {
        // Untuk menghapus kolom jika migration di-rollback
        $table->dropColumn(['payment_proof', 'status']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            //
        });
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('idtraining'); // Relasi ke tabel pelatihan
            $table->unsignedBigInteger('idusers'); // Relasi ke tabel pengguna
            $table->decimal('amount', 15, 2); // Jumlah pembayaran (format desimal)
            $table->string('payment_proof')->nullable(); // Lokasi file bukti pembayaran
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending'); // Status pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}


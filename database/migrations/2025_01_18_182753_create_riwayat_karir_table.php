<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKarirTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_karir', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('posisi_pekerjaan', 255); // Posisi pekerjaan
            $table->string('nama_perusahaan', 255); // Nama perusahaan
            $table->date('mulai_bekerja'); // Tanggal mulai bekerja
            $table->date('selesai_bekerja')->nullable(); // Tanggal selesai bekerja (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_karir');
    }
}

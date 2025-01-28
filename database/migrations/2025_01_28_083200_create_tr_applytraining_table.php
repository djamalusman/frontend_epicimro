<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrApplytrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_applytraining', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('idusers'); // Foreign key untuk user
            $table->unsignedBigInteger('ideducation')->nullable(); // Optional foreign key untuk education
            $table->unsignedBigInteger('idtraining')->nullable(); // Optional foreign key untuk training
            $table->string('positionWork', 255)->nullable(); // Posisi pekerjaan
            $table->string('companyName', 255)->nullable(); // Nama perusahaan
            $table->text('writeskill')->nullable(); // Skill deskripsi
            $table->text('trainingcourse')->nullable(); // Kursus pelatihan
            $table->string('status', 50)->default('pending'); // Status, dengan default pending
            $table->string('app_name', 255)->nullable(); // Nama aplikasi
            $table->string('server_type', 50)->nullable(); // Jenis server
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
        Schema::dropIfExists('tr_applytraining');
    }
}

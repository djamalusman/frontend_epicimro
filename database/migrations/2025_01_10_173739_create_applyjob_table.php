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
        Schema::create('applyjob', function (Blueprint $table) {
            $table->id(); // ID auto increment
            $table->unsignedBigInteger('idusers');
            $table->unsignedBigInteger('idriwayatkarir');
            $table->unsignedBigInteger('idjob');
            $table->text('cover_letter');
            $table->string('cv_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applyjob');
    }
};

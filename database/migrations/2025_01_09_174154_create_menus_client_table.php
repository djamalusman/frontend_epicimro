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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama menu
            $table->string('url')->nullable(); // URL menu
            $table->string('icon')->nullable(); // Ikon menu
            $table->unsignedBigInteger('parent_id')->nullable(); // ID parent untuk sub-menu
            $table->integer('order')->default(0); // Urutan menu
            $table->boolean('is_header')->default(false); // Apakah ini header
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_client');
    }
};

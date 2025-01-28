<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name', 255); // Nama pemilik rekening
            $table->string('account_number', 50)->unique(); // Nomor rekening (unik)
            $table->string('bank_name', 100); // Nama bank
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status rekening
            $table->text('notes')->nullable(); // Catatan tambahan
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
        Schema::dropIfExists('bank_accounts');
    }
}


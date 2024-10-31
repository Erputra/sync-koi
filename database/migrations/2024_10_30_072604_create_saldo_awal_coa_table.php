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
        Schema::create('saldo_awal_coa', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('server_id');
            $table->integer('tahun');
            $table->integer('bulan');
            $table->string('no_akun');
            $table->string('nama_akun');
            $table->decimal('saldo', 15, 2);       // Adjust precision as needed
            $table->decimal('saldo_mu', 15, 2);    // Adjust precision as needed
            $table->string('code_mu');
            $table->decimal('kurs', 10, 4);        // Adjust scale if necessary
            $table->boolean('is_rugilaba');
            $table->string('header_1')->nullable();
            $table->string('header_2')->nullable();
            $table->string('header_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awal_coa');
    }
};

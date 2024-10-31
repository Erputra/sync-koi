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
        Schema::create('akumulasi_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('server_id');
            $table->string('kode_transaksi');
            $table->dateTime('tanggal_transaksi');
            $table->dateTime('jatuh_tempo');
            $table->string('jenis_transaksi');
            $table->string('no_acc_6');
            $table->string('nama_acc_6');
            $table->decimal('value', 15, 2); // Adjust precision as needed
            $table->string('code_mu');
            $table->decimal('kurs', 10, 4); // Adjust scale if necessary
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akumulasi_transaksi');
    }
};

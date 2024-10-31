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
        Schema::create('accounting', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('server_id');
            $table->string('no_bukti');
            $table->dateTime('tanggal_transaksi');
            $table->string('no_faktur');
            $table->string('jenis_slip');
            $table->string('no_urut');
            $table->string('keterangan');
            $table->string('remark');
            $table->string('no_akun');
            $table->decimal('jumlah_debet', 15, 2);
            $table->decimal('jumlah_kredit', 15, 2);
            $table->decimal('jumlah_debet_mu', 15, 2);
            $table->decimal('jumlah_kredit_mu', 15, 2);
            $table->string('code_mu');
            $table->decimal('kurs', 10, 4);
            $table->boolean('is_rugilaba');
            $table->string('header_1');
            $table->string('header_2');
            $table->string('header_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting');
    }
};

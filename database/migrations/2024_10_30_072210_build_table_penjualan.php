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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('server_id');
            $table->string('kode_transaksi');
            $table->dateTime('tanggal');
            $table->boolean('void');
            $table->string('kode_customer');
            $table->string('nama_customer');
            $table->string('kode_gudang');
            $table->string('nama_gudang');
            $table->string('kode_cabang');
            $table->string('nama_cabang');
            $table->string('kode_sales');
            $table->string('nama_sales');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->decimal('konversi', 10, 2);
            $table->decimal('harga_bruto', 15, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('harga_netto', 15, 2);
            $table->decimal('dpp', 15, 2);
            $table->decimal('ppn', 10, 2);
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};

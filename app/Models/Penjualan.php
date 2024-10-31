<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id'; 
    public $timestamps = true; 

    protected $fillable = [
        'app_id',
        'dpp',
        'discount',
        'harga_bruto',
        'harga_netto',
        'jumlah',
        'kode_barang',
        'kode_cabang',
        'kode_customer',
        'kode_gudang',
        'kode_sales',
        'kode_transaksi',
        'konversi',
        'nama_barang',
        'nama_cabang',
        'nama_customer',
        'nama_gudang',
        'nama_sales',
        'ppn',
        'satuan',
        'server_id',
        'tanggal',
        'void',
    ];

}

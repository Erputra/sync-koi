<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accounting extends Model
{
    use HasFactory;

    protected $table = 'accounting';
    protected $primaryKey = 'id'; 
    public $timestamps = true; 

    protected $fillable = [
        'id',
        'app_id',
        'server_id',
        'no_bukti',
        'tanggal_transaksi',
        'no_faktur',
        'jenis_slip',
        'no_urut',
        'keterangan',
        'remark',
        'no_akun',
        'jumlah_debet',
        'jumlah_kredit',
        'jumlah_debet_mu',
        'jumlah_kredit_mu',
        'code_mu',
        'kurs',
        'is_rugilaba',
        'header_1',
        'header_2',
        'header_3',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepaymentJournal extends Model
{
    use HasFactory;

    protected $table = 'jurnal_pelunasan';
    protected $primaryKey = 'id'; 
    public $timestamps = true; 

    protected $fillable = [
        'id',
        'app_id',
        'server_id',
        'kode_transaksi',
        'tanggal_pelunasan',
        'no_bukti',
        'jenis_transaksi',
        'no_acc_6',
        'nama_acc_6',
        'value',
        'code_mu',
        'kurs',
    ];
}












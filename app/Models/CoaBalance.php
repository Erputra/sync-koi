<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoaBalance extends Model
{
    use HasFactory;

    protected $table = 'saldo_awal_coa';
    protected $primaryKey = 'id'; 
    public $timestamps = true; 

    protected $fillable = [
        'id',
        'app_id',
        'server_id',
        'tahun',
        'bulan',
        'no_akun',
        'nama_akun',
        'saldo',
        'saldo_mu',
        'code_mu',
        'kurs',
        'is_rugilaba',
        'header_1',
        'header_2',
        'header_3',
    ];
}
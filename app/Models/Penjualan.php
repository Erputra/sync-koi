<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Specify the table name if it differs from the model name
    protected $primaryKey = 'id'; // Set your primary key if different
    public $timestamps = true; // Set to false if you don't use created_at and updated_at

    protected $fillable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = Schema::getColumnListing($this->table); // Automatically fetch all column names
    }
}

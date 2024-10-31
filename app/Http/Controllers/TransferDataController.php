<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessSales; 


class TransferDataController extends Controller
{
    use ApiResponse;

    public function receive_sales_data(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            '*.App_ID' => 'required|string|max:255',
            '*.Server_ID' => 'required|string|max:255',
            '*.Kode_Transaksi' => 'required|string|max:255',
            '*.Tanggal' => 'required|date',
            '*.Void' => 'boolean',
            '*.Kode_Customer' => 'string|max:255|nullable',
            '*.Nama_Customer' => 'string|max:255|nullable',
            '*.Kode_Gudang' => 'string|max:255|nullable',
            '*.Nama_Gudang' => 'string|max:255|nullable',
            '*.Kode_Cabang' => 'string|max:255|nullable',
            '*.Nama_Cabang' => 'string|max:255|nullable',
            '*.Kode_Sales' => 'string|max:255|nullable',
            '*.Nama_Sales' => 'string|max:255|nullable',
            '*.Kode_Barang' => 'string|max:255|nullable',
            '*.Nama_Barang' => 'string|max:255|nullable',
            '*.Satuan' => 'string|max:50|nullable',
            '*.Konversi' => 'numeric|nullable',
            '*.Harga_Bruto' => 'numeric|nullable',
            '*.Discount' => 'numeric|nullable',
            '*.Harga_Netto' => 'numeric|nullable',
            '*.DPP' => 'numeric|nullable',
            '*.PPN' => 'numeric|nullable',
            '*.Jumlah' => 'numeric|nullable',
        ]);
    
        // Loop through each sale data and dispatch a job
        $salesData = $request->all();
        $lowerCaseSalesData = [];
        
        // Convert keys to lower case for each item in the sales data
        foreach ($salesData as $item) {
            $lowerCaseSalesData[] = array_change_key_case($item, CASE_LOWER);
        }
        Log::debug($lowerCaseSalesData);
        $chunkSize = 100; 
        $chunks = array_chunk($lowerCaseSalesData, $chunkSize);
        foreach ($chunks as $chunk) {
            ProcessSales::dispatch($chunk);
        }
        return $this->successResponse([
            'token' => '$token'], 'Sales records are being processed', 201);
    }
}

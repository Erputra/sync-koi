<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessSales; 
use App\Jobs\ProcessAccounting; 
use App\Jobs\ProcessCoaBalance; 
use App\Jobs\ProcessRepaymentJournal; 
use App\Jobs\ProcessAccumulatedTransactions; 


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

    public function receive_accounting_data(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            '*.App_ID' => 'required|string|max:255',
            '*.Server_ID' => 'required|string|max:255',
            '*.No_Bukti' => 'required|string|max:255',
            '*.Tanggal_Transaksi' => 'required|date',
            '*.No_Faktur' => 'string|max:255|nullable',
            '*.Jenis_Slip' => 'string|max:255|nullable',
            '*.No_Urut' => 'string|max:255|nullable',
            '*.Keterangan' => 'string|max:255|nullable',
            '*.Remark' => 'string|max:255|nullable',
            '*.No_Akun' => 'string|max:255|nullable',
            '*.Jumlah_Debet' => 'numeric|nullable',
            '*.Jumlah_Kredit' => 'numeric|nullable',
            '*.Jumlah_Debet_MU' => 'numeric|nullable',
            '*.Jumlah_Kredit_MU' => 'numeric|nullable',
            '*.Code_MU' => 'string|max:255|nullable',
            '*.Kurs' => 'numeric|nullable',
            '*.Is_RugiLaba' => 'boolean',
            '*.Header_1' => 'string|max:255|nullable',
            '*.Header_2' => 'string|max:255|nullable',
            '*.Header_3' => 'string|max:255|nullable',
        ]);
    
        // Loop through each sale data and dispatch a job
        $accountingData = $request->all();
        $lowerCaseAccountingData = [];
        
        // Convert keys to lower case for each item in the sales data
        foreach ($accountingData as $item) {
            $lowerCaseAccountingData[] = array_change_key_case($item, CASE_LOWER);
        }
        Log::debug($lowerCaseAccountingData);
        $chunkSize = 100; 
        $chunks = array_chunk($lowerCaseAccountingData, $chunkSize);
        foreach ($chunks as $chunk) {
            ProcessAccounting::dispatch($chunk);
        }
        return $this->successResponse([
            'token' => '$token'], 'Accounting records are being processed', 201);
    }

    public function receive_accumulated_transactions_data(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            '*.App_ID' => 'required|string|max:255',
            '*.Server_ID' => 'required|string|max:255',
            '*.Kode_Transaksi' => 'required|string|max:255',
            '*.Tanggal_Transaksi' => 'required|date|nullable',
            '*.Jatuh_Tempo' => 'required|date|nullable',
            '*.Jenis_Transaksi' => 'string|max:255|nullable',
            '*.No_ACC_6' => 'string|max:255|nullable',
            '*.Nama_ACC_6' => 'string|max:255|nullable',
            '*.Value' => 'numeric|nullable',
            '*.Code_MU' => 'string|max:255|nullable',
            '*.Kurs' => 'numeric|nullable',
        ]);
    
        // Loop through each sale data and dispatch a job
        $accumulatedTransactionsData = $request->all();
        $lowerCaseAccumulatedTransactionsData = [];
        
        // Convert keys to lower case for each item in the sales data
        foreach ($accumulatedTransactionsData as $item) {
            $lowerCaseAccumulatedTransactionsData[] = array_change_key_case($item, CASE_LOWER);
        }
        $chunkSize = 100; 
        $chunks = array_chunk($lowerCaseAccumulatedTransactionsData, $chunkSize);
        foreach ($chunks as $chunk) {
            ProcessAccumulatedTransactions::dispatch($chunk);
        }
        return $this->successResponse([
            'token' => '$token'], 'Accumulated Transactions records are being processed', 201);
    }

    public function receive_repayment_journal_data(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            '*.App_ID' => 'required|string|max:255',
            '*.Server_ID' => 'required|string|max:255',
            '*.Kode_Transaksi' => 'required|string|max:255',
            '*.Tanggal_Pelunasan' => 'required|date|nullable',
            '*.No_Bukti' => 'string|max:255|nullable',
            '*.Jenis_Transaksi' => 'string|max:255|nullable',
            '*.No_ACC_6' => 'string|max:255|nullable',
            '*.Nama_ACC_6' => 'string|max:255|nullable',
            '*.Value' => 'numeric|nullable',
            '*.Code_MU' => 'string|max:255|nullable',
            '*.Kurs' => 'numeric|nullable',
        ]);

        // Loop through each sale data and dispatch a job
        $repaymentData = $request->all();
        $lowerCaseRepaymentData = [];
        
        // Convert keys to lower case for each item in the sales data
        foreach ($repaymentData as $item) {
            $lowerCaseRepaymentData[] = array_change_key_case($item, CASE_LOWER);
        }
        $chunkSize = 100; 
        $chunks = array_chunk($lowerCaseRepaymentData, $chunkSize);
        foreach ($chunks as $chunk) {
            ProcessRepaymentJournal::dispatch($chunk);
        }
        return $this->successResponse([
            'token' => '$token'], 'Repayment Journal records are being processed', 201);
    }

    public function receive_coa_balance_data(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            '*.App_ID' => 'required|string|max:255',
            '*.Server_ID' => 'required|string|max:255',
            '*.Tahun' => 'integer|nullable',
            '*.Bulan' => 'integer|nullable',
            '*.No_Akun' => 'string|max:255|nullable',
            '*.Nama_Akun' => 'string|max:255|nullable',
            '*.Saldo' => 'numeric|nullable',
            '*.Saldo_MU' => 'numeric|nullable',
            '*.Code_MU' => 'string|max:255|nullable',
            '*.Kurs' => 'numeric|nullable',
            '*.Is_RugiLaba' => 'boolean',
            '*.Header_1' => 'string|max:255|nullable',
            '*.Header_2' => 'string|max:255|nullable',
            '*.Header_3' => 'string|max:255|nullable',
        ]);

        // Loop through each sale data and dispatch a job
        $coaBalanceData = $request->all();
        $lowerCaseCoaBalanceData = [];
        
        // Convert keys to lower case for each item in the sales data
        foreach ($coaBalanceData as $item) {
            $lowerCaseCoaBalanceData[] = array_change_key_case($item, CASE_LOWER);
        }
        $chunkSize = 100; 
        $chunks = array_chunk($lowerCaseCoaBalanceData, $chunkSize);
        foreach ($chunks as $chunk) {
            ProcessCoaBalance::dispatch($chunk);
        }
        return $this->successResponse([
            'token' => '$token'], 'COA Balance records are being processed', 201);
    }
}

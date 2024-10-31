<?php

namespace App\Jobs;

use App\Models\Penjualan; 
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSales implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $salesData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $salesData)
    {
        $this->salesData = $salesData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Create a new sale record
        // Penjualan::create($this->salesData);
        foreach ($this->salesData as $sales) {
            Penjualan::create($sales);
        }
    }
}

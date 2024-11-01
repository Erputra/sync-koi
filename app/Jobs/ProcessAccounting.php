<?php

namespace App\Jobs;

use App\Models\Accounting; 
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAccounting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $accountingData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $accountingData)
    {
        $this->accountingData = $accountingData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->accountingData as $accounting) {
            Accounting::create($accounting);
        }
    }
}

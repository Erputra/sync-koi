<?php

namespace App\Jobs;

use App\Models\AccumulatedTransactions; 
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ProcessAccumulatedTransactions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $accumulatedTransactionsData;
    
    /**
     * Create a new job instance.
     */
    public function __construct(array $accumulatedTransactionsData)
    {
        $this->accumulatedTransactionsData = $accumulatedTransactionsData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->accumulatedTransactionsData as $accumulated) {
            AccumulatedTransactions::create($accumulated);
        }
    }
}

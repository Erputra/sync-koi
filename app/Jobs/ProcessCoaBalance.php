<?php

namespace App\Jobs;

use App\Models\CoaBalance; 
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCoaBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $coaBalanceData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $coaBalanceData)
    {
        $this->coaBalanceData = $coaBalanceData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->coaBalanceData as $balance) {
            CoaBalance::create($balance);
        }
    }
}

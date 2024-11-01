<?php

namespace App\Jobs;

use App\Models\RepaymentJournal; 
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessRepaymentJournal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $repaymentJournalData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $repaymentJournalData)
    {
        $this->repaymentJournalData = $repaymentJournalData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->repaymentJournalData as $repayment) {
            RepaymentJournal::create($repayment);
        }
    }
}

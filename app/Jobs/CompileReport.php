<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompileReport extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    public $reportId;

    /**
     * Create a new job instance.
     *
     * @param $reportId
     */
    public function __construct($reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump('I am compiling the reports with the id ' . $this->reportId);
    }
}

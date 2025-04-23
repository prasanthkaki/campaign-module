<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CampaignQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $payload;
    public $tries = 5;
    public $timeout = 30;
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Payload received:', $this->payload);
        $id = $this->payload['id'];
        if($id == "abc") {
            Log::error('Job failed because the condition was met in the payload.');
            throw new \Exception('Specific condition met, failing job.');
        }
        Log::info("TestQueueJob executed!", json_encode($this->payload, true));
    }

    public function failed(Exception $exception) {
        Log::error('Job failed: ' . $exception->getMessage());
    }
}

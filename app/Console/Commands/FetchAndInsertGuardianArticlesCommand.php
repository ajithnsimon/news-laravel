<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use App\Services\GuardianApiService;
use App\Jobs\FetchAndInsertGuardianArticlesJob;

class FetchAndInsertGuardianArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:fetch-and-insert-from-guardian-apis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and insert article from Guardian APIs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pass the required arguments to instantiate GuardianApiService
        $apiKey = Config::get('services.guardian.api_key');
        $apiEndpoint = Config::get('services.guardian.endpoint');
        $guardianApiService = new GuardianApiService($apiKey, $apiEndpoint); // You need to instantiate your GuardianApiService
        
        // Dispatch the job to the queue
        FetchAndInsertGuardianArticlesJob::dispatch($guardianApiService);
    }
}

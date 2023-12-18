<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use App\Services\NYTApiService;
use App\Jobs\FetchAndInsertNYTArticlesJob;

class FetchAndInsertNYTArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:fetch-and-insert-from-nyt-apis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and insert article from NYT APIs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pass the required arguments to instantiate NYTApiService
        $apiKey = Config::get('services.nyt.api_key');
        $apiEndpoint = Config::get('services.nyt.endpoint');
        $nytApiService = new NYTApiService($apiKey, $apiEndpoint); // You need to instantiate your NYTApiService

        // Dispatch the job to the queue
        FetchAndInsertNYTArticlesJob::dispatch($nytApiService);
    }
}

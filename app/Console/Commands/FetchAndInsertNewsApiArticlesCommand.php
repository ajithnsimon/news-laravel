<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use App\Services\NewsApiOrgService;
use App\Jobs\FetchAndInsertNewsApiArticlesJob;

class FetchAndInsertNewsApiArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:fetch-and-insert-from-news-api-apis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and insert article from News Api APIs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pass the required arguments to instantiate NewsApiOrgService
        $apiKey = Config::get('services.newsapi.api_key');
        $apiEndpoint = Config::get('services.newsapi.endpoint');
        $newsApiOrgService = new NewsApiOrgService($apiKey, $apiEndpoint); // You need to instantiate your NewsApiOrgService

        // Dispatch the job to the queue
        FetchAndInsertNewsApiArticlesJob::dispatch($newsApiOrgService);
    }
}

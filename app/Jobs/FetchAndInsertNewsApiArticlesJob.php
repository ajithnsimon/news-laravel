<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Modules\Author\Models\Author;
use App\Modules\Source\Models\Source;
use App\Modules\Category\Models\Category;
use App\Modules\Article\Models\Article;
use Log;

class FetchAndInsertNewsApiArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var $newsApiOrgService
     */
    protected $newsApiOrgService;

    /**
     * Create a new job instance.
     *
     * @param $newsApiOrgService $newsApiOrgService
     */
    public function __construct($newsApiOrgService)
    {
        $this->newsApiOrgService = $newsApiOrgService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set the from and to dates
        $fromDate = now()->startOfDay()->toIso8601String();
        $toDate = now()->endOfDay()->toIso8601String();


        // Other API parameters
        $totalPage = 0;
        $currentPage = 1;
        $pageSize = 10;
        $searchQuery = 'article';

        // Fetch data from the News API in batches

        do {
            // Fetch articles data from News API
            $articlesNewsApiData = $this->newsApiOrgService->fetchArticlesDataWrapper($fromDate, $toDate, $currentPage, $pageSize, $searchQuery);


            Log::info($articlesNewsApiData);
            

            // Check if data is not empty before upsert
            if (!empty($articlesNewsApiData['articles'])) {


                // Prepare the data for upsert, including category ID and additional mapping
                $preparedData = array_map(function ($articleData) {

                    // Check if author data is available
                    if ($articleData['author']) {
                        // Upsert author data to the categories table and get the author ID
                        $authorId = Author::updateOrCreate(
                            ['name' => $articleData['author']]
                        )->id;
                    }

                    // Check if source data is available
                    if (@$articleData['source']['name']) {
                        // Upsert source data to the categories table and get the source ID
                        $sourceId = Source::updateOrCreate(
                            ['name' => $articleData['source']['name']]
                        )->id;
                    }

                    if ($articleData['publishedAt']) {
                        
                        $formattedDate = Carbon::parse($articleData['publishedAt'])->toDateString();

                    }

                    // Additional mapping logic
                    return [
                        'title' => $articleData['title'],
                        'content' => $articleData['content'],
                        'date' => $articleData['publishedAt'] ? $formattedDate : Null,
                        'author_id' => $articleData['author'] ? $authorId : Null,
                        'source_id' => @$articleData['source']['name'] ? $sourceId : Null,
                        'api' => 'NewsAPI.org',
                    ];

                }, $articlesNewsApiData['articles']);

                // Perform batch insert into the database
                Article::upsert($preparedData, ['id'], ['title', 'content', 'date', 'author_id', 'source_id', 'api']);

                // Increment the page number for the next batch
                $currentPage++;
                $totalResults = $articlesNewsApiData['totalResults'];
                $totalPage = ceil($totalResults / $pageSize);
            }
        } while ($currentPage <= $totalPage);
    }
}

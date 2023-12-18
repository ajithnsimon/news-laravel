<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Modules\Category\Models\Category;
use App\Modules\Article\Models\Article;

class FetchAndInsertGuardianArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var $guardianApiService
     */
    protected $guardianApiService;

    /**
     * Create a new job instance.
     *
     * @param $guardianApiService
     */
    public function __construct($guardianApiService)
    {
        $this->guardianApiService = $guardianApiService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set the from and to dates
        $fromDate = now()->toDateString();
        $toDate = now()->toDateString();

        // Fetch data from the Guardian API in batches
        $currentPage = 1;
        $pageSize = 10;

        do {
            $articlesGuardianData = $this->guardianApiService->fetchArticlesDataWrapper($fromDate, $toDate, $currentPage, $pageSize);

            // Check if data is not empty before upsert
            if (!empty($articlesGuardianData['response']['results'])) {

                // Prepare the data for upsert, including category ID and additional mapping
                $preparedData = array_map(function ($articleData) {

                    // Check if category data is available
                    if ($articleData['sectionName']) {
                        // Upsert category data to the categories table and get the category ID
                        $categoryId = Category::updateOrCreate(
                            ['name' => $articleData['sectionName']]
                        )->id;
                    }

                    if ($articleData['webPublicationDate']) {
                        
                        $formattedDate = Carbon::parse($articleData['webPublicationDate'])->toDateString();

                    }

                    // Additional mapping logic
                    return [
                        'title' => $articleData['webTitle'],
                        'content' => $articleData['webTitle'],
                        'date' => $articleData['webPublicationDate'] ? $formattedDate : Null,
                        'category_id' => $articleData['sectionName'] ? $categoryId : Null,
                        'api' => 'The Guardian',
                    ];

                }, $articlesGuardianData['response']['results']);

                // Perform batch insert into the database
                Article::upsert($preparedData, ['id'], ['title', 'content', 'date', 'category_id', 'api']);

                // Increment the page number for the next batch
                $currentPage++;
            }
        } while ($currentPage <= @$articlesGuardianData['response']['pages']);
    }
}

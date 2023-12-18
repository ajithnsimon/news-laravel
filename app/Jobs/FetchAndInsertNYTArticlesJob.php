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

class FetchAndInsertNYTArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var $nytApiService
     */
    protected $nytApiService;

    /**
     * Create a new job instance.
     *
     * @param $nytApiService
     */
    public function __construct($nytApiService)
    {
        $this->nytApiService = $nytApiService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set the from and to dates
        $fromDate = now()->startOfDay()->toIso8601ZuluString();
        $toDate = now()->endOfDay()->toIso8601ZuluString();


        // Fetch data from the NYT API in batches
        $currentPage = 1;

        do {
            $articlesNYTData = $this->nytApiService->fetchArticlesDataWrapper($fromDate, $toDate, $currentPage);

            // Check if data is not empty before upsert
            if (!empty($articlesNYTData['response']['docs'])) {


                // Prepare the data for upsert, including category ID and additional mapping
                $preparedData = array_map(function ($articleData) {

                    // Check if author data is available
                    if (@$articleData['byline']['original']) {
                        // Upsert author data to the categories table and get the author ID
                        $name = str_replace('By ', '', $articleData['byline']['original']); 
                        $authorId = Author::updateOrCreate(
                            ['name' => $name]
                        )->id;
                    }

                    // Check if source data is available
                    if ($articleData['source']) {
                        // Upsert source data to the categories table and get the source ID
                        $sourceId = Source::updateOrCreate(
                            ['name' => $articleData['source']]
                        )->id;
                    }

                    // Check if category data is available
                    if ($articleData['section_name']) {
                        // Upsert category data to the categories table and get the category ID
                        $categoryId = Category::updateOrCreate(
                            ['name' => $articleData['section_name']]
                        )->id;
                    }

                    if ($articleData['pub_date']) {
                        
                        $formattedDate = Carbon::parse($articleData['pub_date'])->toDateString();

                    }

                    // Additional mapping logic
                    return [
                        'title' => $articleData['headline']['main'],
                        'content' => $articleData['snippet'],
                        'date' => $articleData['pub_date'] ? $formattedDate : Null,
                        'author_id' => @$articleData['byline']['original'] ? $authorId : Null,
                        'source_id' => $articleData['source'] ? $sourceId : Null,
                        'category_id' => $articleData['section_name'] ? $categoryId : Null,
                        'api' => 'New York Times',
                    ];

                }, $articlesNYTData['response']['docs']);

                // Perform batch insert into the database
                Article::upsert($preparedData, ['id'], ['title', 'content', 'date', 'author_id', 'source_id', 'category_id', 'api']);

                // Increment the page number for the next batch
                $currentPage++;
            }
        } while ($currentPage <= @$articlesNYTData['response']['meta']['hits']);
    }
}

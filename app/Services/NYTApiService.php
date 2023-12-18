<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NYTApiService
{
    /**
     * The API key for the New York Times API.
     *
     * @var string
     */
    private $apiKey;

    /**
     * The API endpoint for the New York Times API.
     *
     * @var string
     */
    private $apiEndpoint;

    /**
     * NYTApiService constructor.
     */
    public function __construct(string $apiKey, string $apiEndpoint)
    {
        // Use the configured API key and endpoint
        $this->apiKey = $apiKey;
        $this->apiEndpoint = $apiEndpoint;
    }
    
    /**
     * Fetch and return articles data from New York Times API.
     *
     * @param string $fromDate The start date for the API query.
     * @param string $toDate   The end date for the API query.
     * @param int    $currentPage     The page number to fetch.
     *
     * @return array The fetched articles data.
     */
    public function fetchArticlesDataWrapper(string $fromDate, string $toDate, int $currentPage = 1): array
    {
        return $this->fetchArticlesData($fromDate, $toDate, $currentPage);
    }

    /**
     * Fetch data from the New York Times API.
     *
     * @param string $fromDate The start date for the API query.
     * @param string $toDate   The end date for the API query.
     * @param int    $currentPage     The page number to fetch.
     *
     * @return array The fetched articles data.
     */
    private function fetchArticlesData(string $fromDate, string $toDate, int $currentPage = 1): array
    {
        // Use the configured API endpoint and key
        $apiUrl = "{$this->apiEndpoint}/svc/search/v2/articlesearch.json?api-key={$this->apiKey}&begin_date={$fromDate}&end_date={$toDate}&page={$currentPage}";

        // Make the API call and return the response
        return $apiResponse = $this->makeApiCall($apiUrl);
    }

    /**
     * Make an API call to the specified URL.
     *
     * @param string $apiUrl The URL to make the API call.
     *
     * @return array The API response.
     */
    private function makeApiCall(string $apiUrl): array
    {
        // Make the API call using Laravel HTTP client
        $response = Http::get($apiUrl);

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            // Return the JSON-decoded response body as an array
            return $response->json();
        } else {
            // If the request was not successful, handle the error (e.g., log, throw exception)
            // For demonstration purposes, return an empty array
            return ['error' => 'API request failed'];
        }
    }
}

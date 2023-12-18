<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GuardianApiService
{
    /**
     * The API key for The Guardian API.
     *
     * @var string
     */
    private $apiKey;

    /**
     * The API endpoint for The Guardian API.
     *
     * @var string
     */
    private $apiEndpoint;

    /**
     * GuardianApiService constructor.
     *
     * @param string $apiKey      The API key for The Guardian API.
     * @param string $apiEndpoint The API endpoint for The Guardian API.
     */
    public function __construct(string $apiKey, string $apiEndpoint)
    {
        // Get API key and endpoint from configuration
        $this->apiKey = $apiKey;
        $this->apiEndpoint = $apiEndpoint;
    }
    
    /**
     * Fetch and return articles data from The Guardian API.
     *
     * @param string $fromDate The start date for the API query.
     * @param string $toDate   The end date for the API query.
     * @param int    $currentPage     The page number to fetch.
     * @param int    $pageSize     The page size to fetch.
     *
     * @return array The fetched articles data.
     */
    public function fetchArticlesDataWrapper(string $fromDate, string $toDate, int $currentPage = 1, int $pageSize = 10): array
    {
        return $this->fetchArticlesData($fromDate, $toDate, $currentPage, $pageSize);
    }

    /**
     * Fetch a specific page of data from The Guardian API.
     *
     * @param string $fromDate The start date for the API query.
     * @param string $toDate   The end date for the API query.
     * @param int    $currentPage     The page number to fetch.
     * @param int    $pageSize     The page size to fetch.
     *
     * @return array The fetched articles data.
     */
    private function fetchArticlesData(string $fromDate, string $toDate, int $currentPage = 1, int $pageSize = 10): array
    {
        // Use the configured API endpoint and key
        $apiUrl = "{$this->apiEndpoint}/search?api-key={$this->apiKey}&from-date={$fromDate}&to-date={$toDate}&page={$currentPage}&page-size={$pageSize}";

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
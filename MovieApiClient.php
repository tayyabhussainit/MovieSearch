<?php

require_once 'config.php';

/**
 * MovieApiClient class to fetch movies
 */
class MovieApiClient
{
    private $apiKey;

    /**
     * Constructor
     * 
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Function to do curl call to fetch movies against given query
     * 
     * @param string $query
     * 
     * @return array
     */
    public function searchMovies($query)
    {
        $query = urlencode($query);
        $query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');
        $query = substr($query, 0, QUERY_LENGTH);
        $apiUrl = "https://api.themoviedb.org/3/search/movie?api_key={$this->apiKey}&query={$query}";

        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        if ($response) {
            $data = json_decode($response, true);
            if ($data === null) {
                throw new Exception('JSON decoding error');
            }

            if ($data['status_code'] === ERROR_STATUS_CODE) {
                throw new Exception($data['status_message']);
            }

            return $data['results'] ?? [];
        }

        return [];
    }
}

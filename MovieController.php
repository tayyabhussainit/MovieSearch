<?php

require_once 'config.php';
require_once 'MovieApiClient.php';

/**
 * MovieController to handle user requests
 */
class MovieController
{
    private $movieApiClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movieApiClient = new MovieApiClient(API_KEY);
    }

    /**
     * Action to search movies
     * 
     * @param string $query
     */
    public function searchMovies($query)
    {
        return $this->movieApiClient->searchMovies($query);
    }
}

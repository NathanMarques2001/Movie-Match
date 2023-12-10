<?php

namespace MovieMatch\Models;

use Dotenv\Dotenv;
use GuzzleHttp\Client;

class TMDBService
{
    private string $apiKey;
    private string $baseURL;

    public function __construct()
    {
        $path = dirname(__DIR__, 2);
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
        $this->apiKey = $_ENV['API_KEY'];
        $this->baseURL = "https://api.themoviedb.org/3";
    }

    public function getTopRated(string $page)
    {
        $finalURL = $this->baseURL . "/movie/top_rated?include_adult=false&include_video=false&language=pt-BR&page=" . $page . "&sort_by=popularity.desc&api_key=" . $this->apiKey;
        $response = $this->buildRequest($finalURL, 'application/json');

        return json_decode($response);
    }

    public function getMovie(int $id)
    {
        $finalURL = $this->baseURL . "/movie/" . $id . "?language=pt-BR&api_key=" . $this->apiKey;
        $response = $this->buildRequest($finalURL, 'application/json');

        return json_decode($response);
    }

    public function getProviders(int $id)
    {
        $finalURL = $this->baseURL . "/movie/" . $id . "/watch/providers?&api_key=" . $this->apiKey;
        $response = $this->buildRequest($finalURL, 'application/json');

        return json_decode($response);
    }

    public function getGenres()
    {
        $finalURL = $this->baseURL . "/genre/movie/list?api_key=" . $this->apiKey;
        $response = $this->buildRequest($finalURL, 'application/json');

        return json_decode($response);
    }

    public function getImage(string $path)
    {
        $finalURL = "https://image.tmdb.org/t/p/w300/" . $path;

        return $this->buildRequest($finalURL, 'Content-Type: image/jpeg');
    }

    private function buildRequest(string $url, string $contentType)
    {
        $client = new Client([
            'verify' => false
        ]);

        $response = $client->request('GET', $url);
        header($contentType);

        return $response->getBody();
    }
}

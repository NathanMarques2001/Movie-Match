<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\TMDBService;

class FilmListController extends Controller
{
  private TMDBService $tmdb;

  public function __construct(TMDBService $tmdb)
  {
    $this->tmdb = $tmdb;
  }

  public function index()
  {
    $currentPage = $this->getCurrentPage();
    $allFilms = $this->loadFilms($currentPage);

    $filmsData = [];
    foreach ($allFilms as $films) {
      $filmsData = array_merge($filmsData, $films->results);
    }

    $filmList = new FilmList();
    $filmList->addAll($filmsData);

    $AI = new RecommendationsModel($filmList->getList());
    $list = $AI->makeRecommendationList();

    return $this->view("films", ['list' => $list, 'tmdb' => $this->tmdb]);
  }

  private function getCurrentPage(): int
  {
    return $_GET['page'] ?? 1;
  }

  private function loadFilms($currentPage)
  {
    $result = [];

    for ($i = $currentPage; $i < $currentPage + 10; $i++) {
      $result[] = $this->tmdb->getTopRated($i);
    }

    return $result;
  }
}

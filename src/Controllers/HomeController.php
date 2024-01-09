<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class HomeController extends Controller
{
  public function render()
  {
    $tmdb = new TMDBService();
    $currentPage = $this->getCurrentPage();
    $allFilms = $this->loadFilms($currentPage, $tmdb);

    $filmsData = [];
    foreach ($allFilms as $films) {
      $filmsData = array_merge($filmsData, $films->results);
    }

    $filmList = new FilmList();
    $filmList->addAll($filmsData);

    $AI = new RecommendationsModel($filmList->getList());
    $list = $AI->makeRecommendationList();

    return $this->view("home", ['list' => $list, 'tmdb' => $tmdb]);
  }

  private function getCurrentPage(): int
  {
    return $_GET['page'] ?? 1;
  }

  private function loadFilms(int $currentPage, TMDBService $tmdb)
  {
    $result = [];

    for ($i = $currentPage; $i < $currentPage + 10; $i++) {
      $result[] = $tmdb->getTopRated($i);
    }

    return $result;
  }

  public function request(): void
  {
    $session = new Session();

    $currentPage = $session->get('currentPage');

    $newPage = $currentPage + 10;
    $session->set('currentPage', $newPage);

    header("Location: http://moviematch.com/home?page=$newPage");
  }
}

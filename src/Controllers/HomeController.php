<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class HomeController extends Controller
{
  private TMDBService $tmdb;
  private Session $session;

  public function __construct(TMDBService $tmdb, Session $session)
  {
    $this->tmdb = $tmdb;
    $this->session = $session;
  }

  public function render()
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

    return $this->view("home", ['list' => $list, 'tmdb' => $this->tmdb]);
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

  public function request(): void
  {
    $currentPage = $this->session->get('currentPage');

    $newPage = $currentPage + 10;
    $this->session->set('currentPage', $newPage);

    header("Location: http://moviematch.com/home?page=$newPage");
  }

  public function logout(): void
  {
    $this->session->logout();
  }
}

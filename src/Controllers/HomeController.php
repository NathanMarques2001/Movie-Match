<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\Redirect;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;
use MovieMatch\Models\UserDatabase;

class HomeController extends Controller
{
  public function render()
  {
    $redirect = new Redirect();
    $redirect->redirectIfNotLoggedIn();
    $redirect->redirectIfNotRated();

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

    $userDB = new UserDatabase(new Database());
    $session = new Session();
    $rated = $userDB->getMovieList($session->get('id'));

    return $this->view("home", ['list' => $list, 'tmdb' => $tmdb, 'rated' => $rated]);
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

  public function notInterested()
  {
    $filmdb = new FilmDatabase(new Database());
    $session = new Session();

    if (isset($_POST["film_id"])) {
      try {
        $notLiked = 0;
        $filmdb->rateFilm($session->get('id'), $_POST["film_id"], $_POST["film_overview"], $notLiked);
        header('Location: /home');
        exit();
      } catch (\Exception $e) {
        $redirect = new Redirect();
        $redirect->handlerError($e);
        exit();
      }
    }
  }

  public function addMovieToList()
  {
    $userDB = new UserDatabase(new Database());
    $session = new Session();

    if (isset($_POST["film_id"])) {
      try {
        $userDB->addMovieToList($session->get('id'), $_POST["film_id"]);
        header('Location: /home');
        exit();
      } catch (\Exception $e) {
        $redirect = new Redirect();
        $redirect->handlerError($e, "/home");
        exit();
      }
    }
  }
}

<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\Film;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\Redirect;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class FilmController extends Controller
{
  public function render()
  {
    $redirect = new Redirect();
    $redirect->redirectIfNotLoggedIn();
    $redirect->redirectIfNotRated();

    $tmdb = new TMDBService();

    $filmID = $this->getFilmIDFromURL();
    $film = $tmdb->getMovie($filmID);
    $providers = $tmdb->getProviders($filmID);

    $movie = new Film(
      $film->title,
      $film->overview,
      $film->release_date,
      $film->genres,
      $film->poster_path,
      $film->vote_average,
      $providers->results->BR->flatrate ?? [],
      $film->backdrop_path,
      $film->tagline,
      $film->id
    );

    $filmDB = new FilmDatabase(new Database());
    $session = new Session();
    $filmRated = $filmDB->getRatedFilm($session->get('id'), $filmID);

    return $this->view("film", ["tmdb" => $tmdb, "movie" => $movie, "filmRated" => $filmRated]);
  }

  public function request()
  {
    $filmdb = new FilmDatabase(new Database());
    $session = new Session();

    if (isset($_POST["liked"]) || isset($_POST["notLiked"])) {
      try {
        $likedOrNot = isset($_POST["liked"]) ? 1 : 0;
        $filmdb->rateFilm($session->get('id'), $_POST["film_id"], $_POST["film_overview"], $likedOrNot);
        header('Location: /home');
        exit();
      } catch (\Exception $e) {
        $redirect = new Redirect();
        $redirect->handlerError($e);
        exit();
      }
    }
  }

  private function getFilmIDFromURL(): int
  {
    $url = $_SERVER['REQUEST_URI'];
    $pattern = '/\/(\d+)/';

    if (preg_match($pattern, $url, $matches)) {
      return (int)$matches[1];
    }

    return 0;
  }
}

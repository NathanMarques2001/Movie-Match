<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Film;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class FilmController extends Controller
{
  private TMDBService $tmdb;
  private FilmDatabase $filmdb;
  private Session $session;

  public function __construct(TMDBService $tmdb, FilmDatabase $filmdb, Session $session)
  {
    $this->tmdb = $tmdb;
    $this->filmdb = $filmdb;
    $this->session = $session;
  }

  public function render()
  {
    $filmID = $this->getFilmIDFromURL();
    $film = $this->tmdb->getMovie($filmID);
    $providers = $this->tmdb->getProviders($filmID);

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

    return $this->view("film", ["tmdb" => $this->tmdb, "movie" => $movie]);
  }

  public function request()
  {
    if (isset($_POST["liked"]) || isset($_POST["notLiked"])) {
      try {
        $likedOrNot = isset($_POST["liked"]) ? 1 : 0;
        $this->filmdb->rateFilm($this->session->get('id'), $_POST["film_id"], $_POST["film_overview"], $likedOrNot);
        header('Location: /home');
        exit();
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  private function getFilmIDFromURL(): int
  {
    $url = $_SERVER['REQUEST_URI'];
    $pattern = '/\/(\d+)\/?$/';

    if (preg_match($pattern, $url, $matches)) {
      return (int)$matches[1];
    }

    return 0;
  }
}

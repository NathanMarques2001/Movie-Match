<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Film;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\TMDBService;

class FilmController extends Controller
{
  private TMDBService $tmdb;
  private FilmDatabase $filmdb;

  public function __construct(TMDBService $tmdb, FilmDatabase $filmdb)
  {
    $this->tmdb = $tmdb;
    $this->filmdb = $filmdb;
  }

  public function index()
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

    return $this->view("Film", ["tmdb" => $this->tmdb, "movie" => $movie]);
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

  public function rateFilm()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["liked"]) || isset($_POST["notLiked"]))) {
      $likedOrNot = isset($_POST["liked"]) ? 1 : 0;
      $this->filmdb->rateFilm($_SESSION["id"], $_POST["film_id"], $_POST["film_overview"], $likedOrNot);
      header('Location: /home');
      exit;
    }
  }
}

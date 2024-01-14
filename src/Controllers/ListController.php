<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\Film;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;
use MovieMatch\Models\UserDatabase;

class ListController extends Controller
{
  public function render()
  {
    $tmdb = new TMDBService();
    $list = $this->getList();
    $movieList = $this->fillList($list);

    return $this->view("list", ["movieList" => $movieList, "tmdb" => $tmdb]);
  }

  public function request()
  {
  }

  private function getList()
  {
    $userDB = new UserDatabase(new Database());
    $session = new Session();
    $list = $userDB->getMovieList($session->get("id"));

    return $list;
  }

  private function getMovieData($film)
  {
    $tmdb = new TMDBService();
    return $tmdb->getMovie($film["id_film"]);
  }

  private function fillList($list)
  {
    $listAux = [];
    foreach ($list as $movie) {
      $film = $this->getMovieData($movie);
      $listAux[] = new Film(
        $film->title,
        $film->overview,
        $film->release_date,
        $film->genres,
        $film->backdrop_path,
        $film->vote_average,
        [],
        $film->backdrop_path,
        $film->tagline,
        $film->id
      );
    }

    return $listAux;
  }
}

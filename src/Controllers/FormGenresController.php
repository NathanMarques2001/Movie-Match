<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Redirect;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class FormGenresController extends Controller
{
  public function render()
  {
    $redirect = new Redirect();
    $redirect->redirectIfNotLoggedIn();
    $redirect->redirectIfAlreadyRated();

    $genres = $this->fillGenresArray();

    return $this->view("form-genres", ['genres' => $genres]);
  }

  public function request()
  {
    $genreDatabase = new GenreDatabase(new Database());
    $session = new Session();
    $genres = $this->fillGenresArray();
    $dbGenres = $this->getGenresDatabase($genreDatabase);

    foreach ($genres as $genre) {
      if (isset($_POST[$genre])) {
        $genreDatabase->createGenresAssessments($session->get('id'), $dbGenres[$genre], $_POST[$genre]);
      }
    }

    header('Location: /home');
  }

  private function fillGenresArray()
  {
    $tmdb = new TMDBService();
    $genres = [];
    $apiGenres = $tmdb->getGenres()->genres;

    foreach ($apiGenres as $apiGenre) {
      $name = $apiGenre->name;
      $genres[] = str_replace(' ', '-', $name);
    }

    return $genres;
  }

  private function getGenresDatabase(GenreDatabase $genreDatabase)
  {
    $dbGenres = array();
    $allGenres = $genreDatabase->getGenres();

    if ($allGenres) {
      foreach ($allGenres as $genre) {
        $dbGenres[$genre["name"]] = $genre["id"];
      }
    }

    return $dbGenres;
  }
}

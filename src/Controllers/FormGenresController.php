<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;

class FormGenresController extends Controller
{
  private GenreDatabase $genreDatabase;
  private TMDBService $tmdb;
  private array $genres;
  private Session $session;

  public function __construct(TMDBService $tmdb, GenreDatabase $genreDatabase, Session $session)
  {
    $this->tmdb = $tmdb;
    $this->genreDatabase = $genreDatabase;
    $this->genres = $this->fillGenresArray();
    $this->session = $session;
  }

  public function render()
  {
    return $this->view("form-genres", ['genres' => $this->genres]);
  }

  public function request()
  {
    $dbGenres = $this->getGenresDatabase();

    foreach ($this->genres as $genre) {
      if (isset($_POST[$genre])) {
        $this->genreDatabase->createGenresAssessments($this->session->get('id'), $dbGenres[$genre], $_POST[$genre]);
      }
    }

    header('Location: /home');
  }

  private function fillGenresArray()
  {
    $genres = [];
    $apiGenres = $this->tmdb->getGenres()->genres;

    foreach ($apiGenres as $apiGenre) {
      $name = $apiGenre->name;
      $genres[] = str_replace(' ', '-', $name);
    }

    return $genres;
  }

  private function getGenresDatabase()
  {
    $dbGenres = array();
    $allGenres = $this->genreDatabase->getGenres();

    if ($allGenres) {
      foreach ($allGenres as $genre) {
        $dbGenres[$genre["name"]] = $genre["id"];
      }
    }

    return $dbGenres;
  }
}

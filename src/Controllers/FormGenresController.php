<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\TMDBService;

class FormGenresController extends Controller
{
  private Database $db;

  public function __construct()
  {
    $this->db = new Database();
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function render()
  {
  }

  public function renderFormPage(): void
  {
    require_once __DIR__ . '/../../templates/views/form-genres.php';
  }

  public function createUserGenresAssessments()
  {
    $tmdb = new TMDBService();
    $apiGenres = $tmdb->getGenres()->genres;
    $genres = [];

    foreach ($apiGenres as $apiGenre) {
      $name = $apiGenre->name;
      $genres[] = str_replace(' ', '-', $name);
    }

    $dbGenres = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $allGenres = $this->db->getGenres();

      if ($allGenres) {
        foreach ($allGenres as $genre) {
          $dbGenres[$genre["name"]] = $genre["id"];
        }
      }
    }

    foreach ($genres as $genre) {
      if (isset($_POST[$genre])) {
        $this->db->createGenresAssessments($_SESSION["id"], $dbGenres[$genre], $_POST[$genre]);
      }
    }

    header('Location: /home');
  }
}

<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\TMDBService;

class HomeController
{
  public function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function renderHomePage(): void
  {
    require_once __DIR__ . '/../../templates/views/home.php';
  }

  public function loadFilms()
  {
    $tmdb = new TMDBService();
    $currentPage = $_GET['page'] ?? 1;

    $result = $tmdb->getTopRated($currentPage);

    return $result->results;
  }

  public function loadOtherMovies(): void
  {
    $currentPage = $_SESSION['currentPage'] ?? 1;

    $newPage = $currentPage + 1;

    $_SESSION['currentPage'] = $newPage;

    header("Location: http://moviematch.com/home?page=$newPage");
  }
}

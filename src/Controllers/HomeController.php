<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\TMDBService;

class HomeController extends Controller
{
  private Database $db;

  public function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    $this->db = new Database();
  }

  public function index()
  {
    $homeController = new HomeController();
    $tmdb = new TMDBService();

    $allFilms = $homeController->loadFilms();
    $filmsData = [];
    foreach ($allFilms as $films) {
      $filmsData = array_merge($filmsData, $films->results);
    }

    $filmList = new FilmList();
    $filmList->addAll($filmsData);

    $AI = new RecommendationsModel($filmList->getList());
    $list = $AI->makeRecommendationList();

    return $this->view("films", ['list' => $list, 'tmdb' => $tmdb]);
  }

  public function renderHomePage(): void
  {
    require_once __DIR__ . '/../../templates/views/home.php';
  }

  public function loadFilms()
  {
    $tmdb = new TMDBService();
    $currentPage = $_GET['page'] ?? 1;

    $result = [];

    for ($i = $currentPage; $i < $currentPage + 10; $i++) {
      $result[] = $tmdb->getTopRated($i);
    }

    return $result;
  }

  public function loadOtherMovies(): void
  {
    $currentPage = $_SESSION['currentPage'] ?? 1;

    $newPage = $currentPage + 10;

    $_SESSION['currentPage'] = $newPage;

    header("Location: http://moviematch.com/home?page=$newPage");
  }

  public function logout(): void
  {
    $this->db->logout();
    header("Location: /");
  }
}

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

  public function render()
  {
    $filmListController = new FilmListController(new TMDBService());
    $filmList = $filmListController->render();

    return $this->view("home", ["filmList" => $filmList]);
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

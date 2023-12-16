<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Authenticate;

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

  public function logout(): void
  {
    $auth = new Authenticate();
    $auth->logout();
    header("Location: /");
  }

  public function loadOtherMovies(): void
  {
    $currentPage = $_SESSION['currentPage'] ?? 1;

    $newPage = $currentPage + 1;

    $_SESSION['currentPage'] = $newPage;

    header("Location: http://moviematch.com/home?page=$newPage");
    exit(); // Certifique-se de sair após o redirecionamento
  }
}

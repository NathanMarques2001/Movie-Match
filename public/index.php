<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\FilmController;
use MovieMatch\Controllers\FormGenresController;
use MovieMatch\Controllers\GenreDatabaseController;
use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignUpController;
use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\LogoutController;
use MovieMatch\Models\Database;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;
use MovieMatch\Models\UserDatabase;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

$logoutController = new LogoutController(new Session());
if(isset($_POST["Logout"])) {
  $logoutController->request();
}
if (!isset($_SESSION['id'])) {
  $loginController = new LoginController(new UserDatabase(new Database()), new GenreDatabase(new Database()), new Session());
  $signUpController = new SignUpController(new UserDatabase(new Database()));
  if ($pathInfo !== "/signup") {
    if ($httpMethod === "GET") {
      $loginController->render();
    } else if (isset($_POST["Login"])) {
      $loginController->request();
    }
  } else if ($pathInfo === "/signup") {
    if ($httpMethod === "GET") {
      $signUpController->render();
    } else if (isset($_POST["Signup"])) {
      $signUpController->request();
    }
  }
} else {
  $genreDatabaseController = new GenreDatabaseController(new GenreDatabase(new Database()), new Session());
  if (!$genreDatabaseController->request()) {
    $formGenresController = new FormGenresController(new TMDBService(), new GenreDatabase(new Database()), new Session());
    if ($httpMethod === "GET") {
      $formGenresController->render();
    } else if (isset($_POST["genres-assessments"])) {
      $formGenresController->request();
    }
  } else {
    $loginController = new LoginController(new UserDatabase(new Database()), new GenreDatabase(new Database()), new Session);
    $homeController = new HomeController(new TMDBService(), new Session());
    if (strpos($pathInfo, "/movie-detail") !== false) {
      $filmController = new FilmController(new TMDBService(), new FilmDatabase(new Database()), new Session());
      if ($httpMethod === "GET") {
        $filmController->render();
      } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $filmController->request();
      }
    } else {
      if ($httpMethod === "GET") {
        $homeController->render();
      } else if (isset($_POST["changeMovies"])) {
        $homeController->request();
      }
    }
  }
}

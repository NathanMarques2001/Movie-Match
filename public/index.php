<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\DatabaseController;
use MovieMatch\Controllers\FilmController;
use MovieMatch\Controllers\FormGenresController;
use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignUpController;
use MovieMatch\Controllers\HomeController;
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
  $databaseController = new DatabaseController();
  if (!$databaseController->checkUserGenreRating()) {
    $formGenresController = new FormGenresController();
    if ($httpMethod === "GET") {
      $formGenresController->renderFormPage();
    } else if (isset($_POST["genres-assessments"])) {
      $formGenresController->createUserGenresAssessments();
    }
  } else {
    $loginController = new LoginController(new UserDatabase(new Database()), new GenreDatabase(new Database()), new Session);
    $homeController = new HomeController();
    if (isset($_POST["Logout"])) {
      $homeController->logout();
    }
    if (strpos($pathInfo, "/movie-detail") !== false) {
      $filmController = new FilmController(new TMDBService, new FilmDatabase);
      if ($httpMethod === "GET") {
        require_once __DIR__ . "/../templates/views/movie-detail.php";
      } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $filmController->request();
      }
    } else {
      if ($httpMethod === "GET") {
        $homeController->render();
      } else if (isset($_POST["changeMovies"])) {
        $homeController->loadOtherMovies();
      }
    }
  }
}

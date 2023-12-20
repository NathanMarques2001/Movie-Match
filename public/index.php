<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\AuthenticateController;
use MovieMatch\Controllers\HomeController;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (!isset($_SESSION['id'])) {
  $authenticateController = new AuthenticateController();
  if ($pathInfo !== "/signup") {
    if ($httpMethod === "GET") {
      $authenticateController->renderLoginPage();
    } else if (isset($_POST["Login"])) {
      $authenticateController->processLogin();
    }
  } else if ($pathInfo === "/signup") {
    if ($httpMethod === "GET") {
      $authenticateController->renderSignupPage();
    } else if (isset($_POST["Signup"])) {
      $authenticateController->processSignup();
    }
  }
} else {
  $authenticateController = new AuthenticateController();
  $homeController = new HomeController();
  if (isset($_POST["Logout"])) {
    $authenticateController->logout();
  }
  if ($pathInfo === "/modal") {
    require_once __DIR__ . "/../templates/views/modal-genres.php";
  } else if (strpos($pathInfo, "/movie-detail") !== false) {
    require_once __DIR__ . "/../templates/views/movie-detail.php";
  } else {
    if ($httpMethod === "GET") {
      $homeController->renderHomePage();
    } else if (isset($_POST["changeMovies"])) {
      $homeController->loadOtherMovies();
    }
  }
}

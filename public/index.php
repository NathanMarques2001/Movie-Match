<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignUpController;
use MovieMatch\Controllers\HomeController;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (!isset($_SESSION['id'])) {
  $loginController = new LoginController();
  $signUpController = new SignUpController();
  if ($pathInfo !== "/signup") {
    if ($httpMethod === "GET") {
      $loginController->renderLoginPage();
    } else if (isset($_POST["Login"])) {
      $loginController->processLogin();
    }
  } else if ($pathInfo === "/signup") {
    if ($httpMethod === "GET") {
      $signUpController->renderSignupPage();
    } else if (isset($_POST["Signup"])) {
      $signUpController->processSignup();
    }
  }
} else {
  $loginController = new LoginController();
  $homeController = new HomeController();
  if (isset($_POST["Logout"])) {
    $homeController->logout();
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

<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignupController;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (!isset($_SESSION['id'])) {
  if ($pathInfo !== "/signup") {
    $loginController = new LoginController();
    if ($httpMethod === "GET") {
      $loginController->renderLoginPage();
    } else if (isset($_POST["Login"])) {
      $loginController->processLogin();
    }
  } else if ($pathInfo === "/signup") {
    $signupController = new SignupController();
    if ($httpMethod === "GET") {
      $signupController->renderSignupPage();
    } else if (isset($_POST["Signup"])) {
      $signupController->processSignup();
    }
  }
} else {
  if (strpos($pathInfo, "/movie-detail") !== false) {
    require_once __DIR__ . "/../templates/views/filmDetail.php";
  } else {
    $homeController = new HomeController();
    if ($httpMethod === "GET") {
      $homeController->renderHomePage();
    } else if (isset($_POST["Logout"])) {
      $homeController->logout();
    } else if (isset($_POST["changeMovies"])) {
      $homeController->loadOtherMovies();
    }
  }
}

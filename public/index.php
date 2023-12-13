<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\LoginController;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (!isset($_SESSION['id'])) {
  $loginController = new LoginController();
  $loginController->renderLoginPage();
  if ($httpMethod === "GET") {
    $loginController->renderLoginPage();
  } else {
    $loginController->processLogin();
  }
} else {
  if ($pathInfo === "/") {
    $loginController = new LoginController();
    if ($httpMethod === "GET") {
      $loginController->renderLoginPage();
    } else if (isset($_POST["Login"])) {
      $loginController->processLogin();
    }
  } else if ($pathInfo === "/home") {
    $homeController = new HomeController();
    if ($httpMethod === "GET") {
      $homeController->renderHomePage();
    } else if (isset($_POST["Logout"])) {
      $homeController->logout();
    }
  }
}

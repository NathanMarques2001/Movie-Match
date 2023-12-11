<?php

require_once __DIR__ . "/../vendor/autoload.php";

use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\LoginController;

if (!isset($_SESSION)) {
  session_start();
}

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (!isset($_SESSION['id'])) {
  $loginController = new LoginController();
  $loginController->renderLoginPage();
} else {
  if ($pathInfo === "/") {
    $loginController = new LoginController();
    if ($httpMethod === "GET") {
      $loginController->renderLoginPage();
    } else {
      $loginController->processLogin();
    }
  } else if ($pathInfo === "/home") {
    $homeController = new HomeController();
    if ($httpMethod === "GET") {
      $homeController->renderHomePage();
    }
  }
}

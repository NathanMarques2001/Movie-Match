<?php

namespace MovieMatch\Config;

use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignUpController;
use MovieMatch\Controllers\LogoutController;
use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\FilmController;

class Router
{
  private string $method;
  private string $path;

  public function __construct(string $method, string $path)
  {
    $this->method = $method;
    $this->path = $path;
  }

  public function route()
  {
    $routes = [
      'GET' => [
        '' => [LoginController::class, 'render'],
        'signup' => [SignUpController::class, 'render'],
        'home' => [HomeController::class, 'render'],
        'movie-detail' => [FilmController::class, 'render'],
      ],
      'POST' => [
        '' => [LoginController::class, 'request'],
        'signup' => [SignUpController::class, 'request'],
        'home' => [HomeController::class, 'request'],
        'movie-detail' => [FilmController::class, 'request'],
        'logout' => [LogoutController::class, 'request'],
      ],
    ];
    if (isset($_POST["Logout"])) {
      $this->setPath('logout');
    }
    if (isset($routes[$this->method][$this->path])) {
      [$controllerClass, $method] = $routes[$this->method][$this->path];
      $controller = new $controllerClass();

      $controller->$method();
    } else {
      http_response_code(404);
    }
  }

  private function setPath(string $path)
  {
    $this->path = $path;
  }
}

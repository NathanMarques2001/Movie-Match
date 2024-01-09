<?php

use MovieMatch\Controllers\LoginController;
use MovieMatch\Controllers\SignUpController;
use MovieMatch\Controllers\LogoutController;
use MovieMatch\Controllers\FormGenresController;
use MovieMatch\Controllers\GenreDatabaseController;
use MovieMatch\Controllers\HomeController;
use MovieMatch\Controllers\FilmController;
use MovieMatch\Models\Database;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;
use MovieMatch\Models\TMDBService;
use MovieMatch\Models\UserDatabase;

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
      'GET|/' => [LoginController::class, 'render'],
      'POST|/login' => [LoginController::class, 'request'],
      'GET|/signup' => [SignUpController::class, 'render'],
      'POST|/signup' => [SignUpController::class, 'request'],
      'POST|/logout' => [LogoutController::class, 'request'],
      
    ];

    $key = "$this->method|$this->path";

    if (isset($routes[$key])) {
      [$controllerClass, $method] = $routes[$key];
      $controller = new $controllerClass(
        new UserDatabase(new Database()),
        new GenreDatabase(new Database()),
        new Session()
      );

      $controller->$method();
    } else {
      echo "Rota não encontrada!";
    }
  }
}

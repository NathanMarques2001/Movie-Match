<?php

namespace MovieMatch\Models;

use MovieMatch\Controllers\GenreDatabaseController;

class Redirect
{
  public function redirectIfAlreadyRated()
  {
    $genreDatabaseController = new GenreDatabaseController();

    if ($genreDatabaseController->request()) {
      header('Location: /home');
      exit();
    }
  }

  public function redirectIfNotRated()
  {
    $genreDatabaseController = new GenreDatabaseController();

    if (!$genreDatabaseController->request()) {
      header('Location: /first-login');
      exit();
    }
  }

  public function redirectIfIsLoggedIn()
  {
    $auth = new Auth();
    if ($auth->isLoggedIn()) {
      header("Location: /home");
    }
  }

  public function redirectIfNotLoggedIn()
  {
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
      header("Location: /");
    }
  }

  public function handlerError(\Exception $e)
  {
    header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?error=" . $e->getMessage());
  }
}

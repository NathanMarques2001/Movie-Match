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

  public function userIsLoggedIn()
  {
    $session = new Session();

    if ($session->get('id') != null) {
      header('Location: /home');
      exit();
    }
  }

  public function userIsNotLoggedIn()
  {
    $session = new Session();

    if ($session->get('id') == null) {
      header('Location: /');
      exit();
    }
  }
}

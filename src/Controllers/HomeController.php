<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Authenticate;

class HomeController
{
  public function __construct()
  {
  }

  public function renderHomePage(): void
  {
    require_once __DIR__ . '/../Views/home.php';
  }

  public function logout(): void
  {
    $auth = new Authenticate();
    $auth->logout();
  }
}

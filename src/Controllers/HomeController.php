<?php

namespace MovieMatch\Controllers;

class HomeController
{
  public function __construct()
  {
  }

  public function renderHomePage(): void
  {
    require_once __DIR__ . '/../Views/home.php';
  }
}

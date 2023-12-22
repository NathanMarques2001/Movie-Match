<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;

class DatabaseController
{
  private Database $auth;

  public function __construct()
  {
    $this->auth = new Database();
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function checkUserGenreRating()
  {
    if ($this->auth->checkGenreAssessment($_SESSION["id"])) {
      return true;
    }
    return false;
  }
}

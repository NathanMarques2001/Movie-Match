<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;

class DatabaseController
{
  private Database $db;

  public function __construct()
  {
    $this->db = new Database();
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function checkUserGenreRating()
  {
    if ($this->db->checkGenreAssessment($_SESSION["id"])) {
      return true;
    }
    return false;
  }
}

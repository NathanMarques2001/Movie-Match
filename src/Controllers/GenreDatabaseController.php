<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;

class GenreDatabaseController
{
  public function request()
  {
    $genreDatabase = new GenreDatabase(new Database());
    $session = new Session();

    if ($genreDatabase->checkGenreAssessment($session->get('id'))) {
      return true;
    }
    return false;
  }
}

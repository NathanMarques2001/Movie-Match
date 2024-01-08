<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;

class GenreDatabaseController
{
  private GenreDatabase $genreDatabase;
  private Session $session;

  public function __construct(GenreDatabase $genreDatabase, Session $session)
  {
    $this->genreDatabase = $genreDatabase;
    $this->session = $session;
  }

  public function request()
  {
    if ($this->genreDatabase->checkGenreAssessment($this->session->get('id'))) {
      return true;
    }
    return false;
  }
}

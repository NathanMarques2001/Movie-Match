<?php

namespace MovieMatch\Models;

use MovieMatch\Models\Film;

class FilmList
{
  private array $list;

  public function __construct()
  {
    $this->list = [];
  }

  public function getList(): array
  {
    return $this->list;
  }

  public function add(Film $value): void
  {
    $this->list[] = $value;
  }
}

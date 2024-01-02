<?php

namespace MovieMatch\Models;

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

  public function addAll(array $films): void
  {
    foreach ($films as $filmData) {
      $film = new Film(
        $filmData->title,
        $filmData->overview,
        $filmData->release_date,
        $filmData->genre_ids,
        $filmData->backdrop_path,
        $filmData->vote_average,
        [],
        $filmData->poster_path,
        "",
        $filmData->id
      );
      if ($film->getOverview() != null) {
        $this->add($film);
      }
    }
  }
}

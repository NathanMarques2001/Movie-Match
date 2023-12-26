<?php

namespace MovieMatch\Models;

class RecommendationEngine
{
  private User $user;
  private Film $film;
  private const THRESHOLD = 5;

  public function __construct(User $user, Film $film)
  {
    $this->user = $user;
    $this->film = $film;
  }

  public function gradeProcessor()
  {
    $finalGrade = $this->calculateFinalGrade();

    if ($finalGrade >= self::THRESHOLD * count($this->film->getGenres())) {
      return "FILME RECOMENDADO!";
    }

    return "FILME NÃO RECOMENDADO";
  }

  private function calculateFinalGrade()
  {
    $finalGrade = 0;

    foreach ($this->film->getGenres() as $genre) {
      $finalGrade += $this->user->getGrade($genre->id);
    }

    return $finalGrade;
  }
}

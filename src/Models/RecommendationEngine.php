<?php

namespace MovieMatch\Models;

class RecommendationEngine
{
  private User $user;
  private const THRESHOLD = 5;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function gradeProcessor(Film $film)
  {
    $finalGrade = $this->calculateFinalGrade($film);
    $genresQuantity = count($film->getGenres());
    $percentageGrade = $film->getGradeWithPercentage($genresQuantity, $finalGrade);
    $film->setUserGrade($percentageGrade);

    if ($finalGrade >= self::THRESHOLD * $genresQuantity) {
      return $film;
    }
  }

  private function calculateFinalGrade(Film $film)
  {
    $finalGrade = 0;

    foreach ($film->getGenres() as $genre) {
      $finalGrade += $this->user->getGrade($genre);
    }

    return $finalGrade;
  }
}

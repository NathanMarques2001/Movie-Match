<?php

namespace MovieMatch\Models;

use MovieMatch\Models\NLPProcessor;
use MovieMatch\Models\User;

class RecommendationsModel
{
  private NLPProcessor $NLPProcessor;
  private RecommendationEngine $recommendationEngine;
  private array $filmList;

  public function __construct(User $user, array $filmList)
  {
    $this->NLPProcessor = new NLPProcessor();
    $this->recommendationEngine = new RecommendationEngine($user);
    $this->filmList = $filmList;
  }

  public function makeRecommendationList()
  {
    $listRecommendation = [];
    if (!isset($_POST["genres-assessments"])) {
      foreach ($this->filmList as $film) {
        $tempFilm = $this->recommendationEngine->gradeProcessor($film);
        if ($tempFilm) {
          $listRecommendation[] = $tempFilm;
        }
      }
      return $this->sortFilmsByUserGrade($listRecommendation);
    }
    return [];
  }

  public function sortFilmsByUserGrade(array $list): array
  {
    $compareByUserGrade = function (Film $film1, Film $film2) {
      return $film2->getUserGrade() - $film1->getUserGrade();
    };

    usort($list, $compareByUserGrade);

    return $list;
  }
}

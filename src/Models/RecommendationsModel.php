<?php

namespace MovieMatch\Models;

use MovieMatch\Models\NLPProcessor;
use MovieMatch\Models\User;
use MovieMatch\Models\Film;

class RecommendationsModel
{
  private NLPProcessor $NLPProcessor;
  private RecommendationEngine $recommendationEngine;

  public function __construct(User $user, Film $film)
  {
    $this->NLPProcessor = new NLPProcessor();
    $this->recommendationEngine = new RecommendationEngine($user);
  }

  public function makeRecommendationList(): array
  {
    if (!isset($_POST["genres-assessments"])) {
    }
    return [];
  }
}

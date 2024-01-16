<?php

namespace MovieMatch\Models;

class RecommendationsModel
{
  private User $user;
  private NLPProcessor $NLPProcessor;
  private RecommendationEngine $recommendationEngine;
  private array $filmList;

  public function __construct(array $filmList)
  {
    $this->filmList = $filmList;
    $this->user = new User($_SESSION["name"], $this->getUserGrades(), $this->getRatedFilms());
    $this->NLPProcessor = new NLPProcessor();
    $this->recommendationEngine = new RecommendationEngine($this->user);
  }

  public function makeRecommendationList()
  {
    $listRecommendation = [];
    if (!isset($_POST["genres-assessments"])) {
      $rateds = $this->makeUserList();
      $listRecommendation = $this->listWithoutNLP($rateds);
      if (!empty($rateds)) {
        $listRecommendation = $this->listWithNLP($rateds, $listRecommendation);
      }
      return $this->sortFilmsByUserGrade($listRecommendation);
    }
    return [];
  }

  private function sortFilmsByUserGrade(array $list): array
  {
    $compareByUserGrade = function (Film $film1, Film $film2) {
      return $film2->getUserGrade() - $film1->getUserGrade();
    };

    usort($list, $compareByUserGrade);

    return $list;
  }

  private function listWithoutNLP(array $rateds): array
  {
    $listRecommendation = [];
    foreach ($this->filmList as $film) {
      $tempFilm = $this->recommendationEngine->gradeProcessor($film);
      if (!empty($rateds) && $tempFilm) {
        if (!array_key_exists($tempFilm->getID(), $rateds)) {
          $listRecommendation[] = $tempFilm;
        }
      } else if ($tempFilm) {
        $listRecommendation[] = $tempFilm;
      }
    }
    return $listRecommendation;
  }

  private function listWithNLP(array $rateds, array $listRecommendation): array
  {
    $list = [];
    foreach ($listRecommendation as $film) {
      foreach ($rateds as $rated) {
        $grade = $this->NLPProcessor->calculateSimilarity($rated["overview"], $film);
        $grade = $rated["rated"] == 0 ? $grade * (-1) : $grade;
        $finalGrade = $grade + $film->getUserGrade();
        $film->setUserGrade($finalGrade);
      }
      $list[] = $film;
    }
    return $list;
  }

  private function makeUserList(): array
  {
    $rateds = $this->user->getRateds();
    $assocArray = array();
    foreach ($rateds as $rated) {
      $assocArray[$rated["id_film"]] = $rated;
    }

    return $assocArray;
  }

  private function getUserGrades()
  {
    $genresDB = new GenreDatabase(new Database());
    $grades = $genresDB->getGenreAssessment($_SESSION["id"]);

    $finalGrades = array();
    foreach ($grades as $grade) {
      $finalGrades[$grade["id_genre"]] = $grade["grade"];
    }

    return $finalGrades;
  }

  private function getRatedFilms()
  {
    $filmsDB = new FilmDatabase(new Database());
    return $filmsDB->getRatedFilms($_SESSION["id"]);
  }
}

<?php

use MovieMatch\Controllers\HomeController;
use MovieMatch\Models\Database;
use MovieMatch\Models\FilmList;
use MovieMatch\Models\RecommendationsModel;
use MovieMatch\Models\TMDBService;
use MovieMatch\Models\User;

$homeController = new HomeController();
$tmdb = new TMDBService();
$db = new Database();

$allFilms = $homeController->loadFilms();
$filmsData = [];
foreach ($allFilms as $films) {
  $filmsData = array_merge($filmsData, $films->results);
}
$grades = $db->getGenreAssessment($_SESSION["id"]);

$filmList = new FilmList();
$filmList->addAll($filmsData);

$finalGrades = array();
foreach ($grades as $grade) {
  $finalGrades[$grade["id_genre"]] = $grade["grade"];
}

$AI = new RecommendationsModel(new User($_SESSION["name"], $finalGrades, [], []), $filmList->getList());

$list = $AI->makeRecommendationList();
?>

<div id="films-container">
  <h1>Recomendações de Filmes</h1>
  <main id="films-slider">
    <?php foreach ($list as $film) : ?>
      <div class="card" style="margin-right: 1rem;">
        <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $film->getTitle() ?></h5>
          <p class="card-text" style="height: 320px; overflow: auto;"><?= $film->getOverview() ?></p>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary">Mais Detalhes</a>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
  <form action="http://moviematch.com/home" method="POST">
    <button type="submit" class="btn btn-primary btn-lg mb-3" name="changeMovies">Novas recomendações</button>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('#films-slider').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      prevArrow: '<button type="button" class="slick-prev btn-slider"><img src="http://moviematch.com/assets/arrow-left.png" alt=""></button>',
      nextArrow: '<button type="button" class="slick-next btn-slider"><img src="http://moviematch.com/assets/arrow-right.png" alt=""></button>',
    });
  });
</script>
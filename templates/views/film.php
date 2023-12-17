<?php

use MovieMatch\Models\Film;
use MovieMatch\Models\TMDBService;

$parts = explode('/', $_SERVER['REQUEST_URI']);
$filmID = $parts[2];

$tmdb = new TMDBService();
$film = $tmdb->getMovie($filmID);
$providers = $tmdb->getProviders($filmID);

$movie = new Film(
  $film->title,
  $film->overview,
  $film->release_date,
  $film->genres,
  $film->poster_path,
  $film->vote_average,
  $providers->results->BR->flatrate,
  $film->backdrop_path,
  $film->tagline,
  $film->id
);
?>

<div id="filmDetail-container" style="background-image: url('<?= $tmdb->getBackground($movie->getBackgroundPath()); ?>');">
  <div id="filmDetail-content">
    <img src="<?= $tmdb->getImage($movie->getImagePath()); ?>" alt="Pôster <?= $movie->getTitle() ?>" id="filmDetail-img">
    <div>
      <h1><?= $movie->getTitle() ?> &lpar;<?= $movie->getYear() ?>&rpar;</h1>
      <p><?= $movie->extractGenres() ?></p>
      <p>Avaliação -> <?= $movie->ratingPercentage() ?>%</p>
      <p><?= $movie->getTagline() ?></p>
      <p>Sinopse</p>
      <p><?= $movie->getOverview() ?></p>
      <p>Streamings</p>
      <p><?= $movie->extractStreamings() ?></p>
    </div>
  </div>
</div>
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
  $providers->results->BR->flatrate ?? [],
  $film->backdrop_path,
  $film->tagline,
  $film->id
);
?>

<div id="filmDetail-container" style="background-image: url('<?= $tmdb->getBackground($movie->getBackgroundPath()); ?>');">
  <div id="filmDetail-content">
    <div id="filmDetail-image-container">
      <img src="<?= $tmdb->getImage($movie->getImagePath()); ?>" alt="Pôster <?= $movie->getTitle() ?>" id="filmDetail-img">
      <?php foreach ($movie->getStreamings() as $streaming) : ?>
        <div class="filmDetail-container-streamings">
          <img src="<?= $tmdb->getImage($streaming->logo_path); ?>" alt="Logo <?= $streaming->provider_name ?>" class="filmDetail-logo-streaming">
          <span><?= $streaming->provider_name ?></span>
        </div>
      <?php endforeach; ?>
      <?php if (empty($movie->getStreamings())) : ?>
        <div class="filmDetail-container-streamings">
          <span><?= "Não disponível em serviços de streaming!" ?></span>
        </div>
      <?php endif; ?>
    </div>
    <div id="filmDetail-info-container">
      <h1><strong><?= $movie->getTitle() ?></strong> <span id="filmDetail-title-year">&lpar;<?= $movie->getYear() ?>&rpar;</span></h1>
      <p>
        <span>
          <strong>Lançamento: </strong>
          <?= $movie->formatDate() ?>
        </span>
        <span>&#45;</span>
        <span>
          <strong>Gêneros: </strong>
          <?= $movie->extractGenres() ?>
        </span>
      </p>
      <p>
        <strong>Avaliação dos usuários: </strong>
        <?= $movie->ratingPercentage() ?>%
      </p>
      <p id="filmDetail-tagline"><?= $movie->getTagline() ?></p>
      <h4>Sinopse</h4>
      <p><?= $movie->getOverview() ?></p>
    </div>
  </div>
</div>
<?php

use MovieMatch\Models\TMDBService;

$tmdb = new TMDBService();

$parts = explode('/', $_SERVER['REQUEST_URI']);
$filmID = $parts[2];

$film = $tmdb->getMovie($filmID);
$providers = $tmdb->getProviders($filmID);
$streamings = $providers->results->BR->flatrate;
$year = substr($film->release_date, 0, 4);

$genreNames = array_map(function ($genre) {
  return $genre->name;
}, $film->genres);

$genres = implode(', ', $genreNames);

$streamingsName = array_map(function ($streaming) {
  return $streaming->provider_name;
}, $providers->results->BR->flatrate);

$streamings = implode(', ', $streamingsName);
?>

<div id="filmDetail-container" style="background-image: url('<?= $tmdb->getBackground($film->backdrop_path); ?>');">
  <div id="filmDetail-content">
    <img src="<?= $tmdb->getImage($film->poster_path); ?>" alt="Pôster <?= $film->title ?>" id="filmDetail-img">
    <div>
      <h1><?= $film->title ?> &lpar;<?= $year ?>&rpar;</h1>
      <p><?= $genres ?></p>
      <p>Avaliação -> <?= round($film->vote_average * 10) ?>%</p>
      <p><?= $film->tagline ?></p>
      <p>Sinopse</p>
      <p><?= $film->overview ?></p>
      <p>Streamings</p>
      <p><?= $streamings ?></p>
    </div>
  </div>
</div>
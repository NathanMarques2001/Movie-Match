<?php

use MovieMatch\Models\TMDBService;

$tmdb = new TMDBService();

$parts = explode('/', $_SERVER['REQUEST_URI']);
$filmID = $parts[2];

$film = $tmdb->getMovie($filmID);
$providers = $tmdb->getProviders($filmID);
$streamings = $providers->results->BR->flatrate;
?>

<div id="filmDetail-container" style="background-image: url('<?= $tmdb->getBackground($film->backdrop_path); ?>');">
  <div id="filmDetail-content">
    <h1><?= $film->title ?></h1>
    <img src="<?= $tmdb->getImage($film->poster_path); ?>" alt="">
    <p><?= $film->overview ?></p>
    <p>Gêneros</p>
    <ul>
      <?php foreach ($film->genres as $genre) : ?>
        <li><?= $genre->name ?></li>
      <?php endforeach; ?>
    </ul>
    <p>Streamings</p>
    <ul>
      <?php foreach ($streamings as $streaming) : ?>
        <li><?= $streaming->provider_name ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
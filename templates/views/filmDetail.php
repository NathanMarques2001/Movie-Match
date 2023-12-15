<?php require_once __DIR__ . "/../../templates/layout/header.html"; ?>
<?php require_once __DIR__ . "/../../templates/layout/navbar.html"; ?>

<?php

use MovieMatch\Models\TMDBService;

$tmdb = new TMDBService();

$parts = explode('/', $_SERVER['REQUEST_URI']);
$filmID = $parts[2];

$film = $tmdb->getMovie($filmID);
$providers = $tmdb->getProviders($filmID);
$streamings = $providers->results->BR->flatrate;

?>

<h1><?= $film->title ?></h1>
<img src="<?= $tmdb->getImage($film->backdrop_path); ?>" alt="">
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

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
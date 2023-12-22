<?php

use MovieMatch\Controllers\HomeController;
use MovieMatch\Models\Film;
use MovieMatch\Models\FilmList;
use MovieMatch\Models\TMDBService;

$homeController = new HomeController();
$tmdb = new TMDBService();

$filmsData = $homeController->loadFilms();

$filmList = new FilmList();
foreach ($filmsData as $filmData) {
  $film = new Film(
    $filmData->title,
    $filmData->overview,
    $filmData->release_date,
    $filmData->genre_ids,
    $filmData->backdrop_path,
    $filmData->vote_average,
    [],
    $filmData->poster_path,
    "",
    $filmData->id
  );

  $filmList->add($film);
}
?>

<div id="films-container">
  <h1>Recomendações de Filmes</h1>
  <main id="films-list">
    <?php foreach ($filmList->getList() as $film) : ?>
      <div class="card mb-3" style="max-width: 18rem;">
        <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $film->getTitle() ?></h5>
          <p class="card-text" style="max-width: 18rem; height: 320px; overflow: auto;"><?= $film->getOverview() ?></p>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary">Mais Detalhes</a>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
  <form action="http://moviematch.com/home" method="POST">
    <button type="submit" class="btn btn-primary btn-lg mb-3" name="changeMovies">Novas recomendações</button>
  </form>
</div>
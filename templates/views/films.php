<?php

use MovieMatch\Controllers\HomeController;
use MovieMatch\Models\TMDBService;

$homeController = new HomeController();
$tmdb = new TMDBService();

$films = $homeController->loadFilms();

?>

<div id="films-container">
  <h1>Recomendações de Filmes</h1>
  <main id="films-list">
    <?php foreach ($films as $film) : ?>
      <div class="card mb-3" style="max-width: 18rem;">
        <img src="<?= $tmdb->getImage($film->backdrop_path); ?>" class="card-img-top" alt="Pôster - <?= $film->title ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $film->title ?></h5>
          <p class="card-text" style="max-width: 18rem; height: 320px; overflow: auto;"><?= $film->overview ?></p>
          <a href="http://moviematch.com/movie-detail/<?= $film->id ?>" class="btn btn-primary">Mais Detalhes</a>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
  <form action="http://moviematch.com/home" method="POST">
    <button type="submit" class="btn btn-primary btn-lg mb-3" name="changeMovies">Novas recomendações</button>
  </form>
</div>
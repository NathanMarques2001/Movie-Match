<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body>
  <div id="films-container">
    <h1>Recomendações de Filmes</h1>
    <main id="films-slider">
      <?php foreach ($list as $film) : ?>
        <div class="card" style="margin-right: 1rem;">
          <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
          <div class="card-body">
            <h5 class="card-title" style="min-height: 4rem; display:flex;justify-content:center;align-items:center;"><?= $film->getTitle() ?></h5>
            <p class="card-text" style="height: 320px; overflow: auto;"><?= $film->getOverview() ?></p>
            <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-info" style="width:95%;">Mais Detalhes</a>
            <form action="http://moviematch.com/add-list" method="POST">
              <input type="hidden" name="film_id" value="<?= $film->getId() ?>">
              <button class="btn btn-success" style="width:95%;">Adicionar a lista</button>
            </form>
            <form action="http://moviematch.com/not-interested" method="POST">
              <input type="hidden" name="film_id" value="<?= $film->getId() ?>">
              <input type="hidden" name="film_overview" value="<?= $film->getOverview() ?>">
              <button class="btn btn-danger" style="width:95%;">Não me interessa</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </main>
    <form action="http://moviematch.com/home" method="POST">
      <button type="submit" class="btn btn-primary btn-lg mb-5" name="changeMovies" style="width:60%;">Novas recomendações</button>
    </form>
  </div>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
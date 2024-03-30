<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body>
  <div id="films-container">
    <h2>Recomendações Sob Medida</h2>
    <main id="films-slider">
      <?php foreach ($list as $film) : ?>
        <div class="card home-card">
          <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
          <div class="card-body">
            <h5 class="card-title home-card-title"><?= $film->getTitle() ?></h5>
            <p class="card-text home-card-text"><?= $film->getOverview() ?></p>
            <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-info home-btn">Mais Detalhes</a>
            <?php $inList = false; ?>
            <?php foreach ($rated as $rat) : ?>
              <?php if ($film->getID() == $rat['id_film']) : ?>
                <?php $inList = true; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($inList) : ?>
              <button class="btn btn-success home-btn" disabled>Já está na lista</button>
            <?php else : ?>
              <form action="http://moviematch.com/add-list" method="POST">
                <input type="hidden" name="film_id" value="<?= $film->getID() ?>">
                <button class="btn btn-success home-btn">Adicionar a lista</button>
              </form>
            <?php endif; ?>
            <form action="http://moviematch.com/not-interested" method="POST">
              <input type="hidden" name="film_id" value="<?= $film->getID() ?>">
              <input type="hidden" name="film_overview" value="<?= $film->getOverview() ?>">
              <button class="btn btn-danger home-btn">Não me interessa</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </main>
    <form action="http://moviematch.com/home" method="POST">
      <button type="submit" class="btn btn-primary btn-lg mb-5 home-btn-more-recommendations" name="changeMovies">Novas recomendações</button>
    </form>
  </div>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
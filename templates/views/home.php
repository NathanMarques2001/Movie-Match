<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body>
  <div id="films-container">
    <h1>Recomendações de Filmes<?= $_SESSION["id"]; ?></h1>
    <main id="films-slider">
      <?php foreach ($list as $film) : ?>
        <div class="card" style="margin-right: 1rem;">
          <h3><?= $film->getUserGrade() ?></h3>
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
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
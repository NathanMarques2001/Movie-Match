<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body id="list-body">
  <h2>Sua Lista de Filmes</h2>
  <main id="list-container">
    <?php if (empty($movieList)) : ?>
      <h3 id="list-text"><?= "Você ainda não adicionou nada a sua lista!" ?></h3>
    <?php endif; ?>
    <?php foreach ($movieList as $film) : ?>
      <div class="card list-card">
        <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title list-card-title"><?= $film->getTitle() ?></h5>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary list-btn">Mais detalhes</a>
          <form action="http://moviematch.com/list" method="POST">
            <input type="hidden" name="film_id" value="<?= $film->getId() ?>">
            <button class="btn btn-danger list-btn">Retirar da lista</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body>
  <div>
    <?php if (empty($movieList)) : ?>
      <div>
        <p><?= "Você ainda não adicionou nada a sua lista!" ?></p>
      </div>
    <?php endif; ?>
    <?php foreach ($movieList as $film) : ?>
      <div class="card" style="width: 18rem;">
      <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $film->getTitle() ?></h5>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary">Mais detalhes</a>
          <a href="#" class="btn btn-primary">Retirar da lista</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
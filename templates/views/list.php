<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body style="background-color:#060738;">
  <div style="display:flex;align-items:center;justify-content:center;min-height:80vh; flex-wrap: wrap; gap: 2%; margin-top: 4%">
    <?php if (empty($movieList)) : ?>
      <h1 style="color: white;"><?= "Você ainda não adicionou nada a sua lista!" ?></h1>
    <?php endif; ?>
    <?php foreach ($movieList as $film) : ?>
      <div class="card" style="width: 18rem; margin-bottom: 2%;">
        <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title" style="min-height: 8rem; display:flex;align-items:center;justify-content:center; text-align: center;"><?= $film->getTitle() ?></h5>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary" style="width: 95%;">Mais detalhes</a>
          <form action="http://moviematch.com/list" method="POST">
            <input type="hidden" name="film_id" value="<?= $film->getId() ?>">
            <button class="btn btn-danger" style="width: 95%;">Retirar da lista</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
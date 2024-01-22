<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body id="assessments-body">
  <main id="assessments-container">
    <?php if (empty($movieList)) : ?>
      <h1 id="assessments-text"><?= "Você ainda não avaliou nenhum filme!" ?></h1>
    <?php endif; ?>
    <?php foreach ($movieList as $film) : ?>
      <div class="card assessments-card" style="background-color: <?= $film->getUserGrade() == 1 ? 'green' : 'red' ?>;">
        <img src="<?= $tmdb->getImage($film->getImagePath()); ?>" class="card-img-top" alt="Pôster - <?= $film->getTitle() ?>">
        <div class="card-body">
          <h5 class="card-title assessments-card-title"><?= $film->getTitle() ?></h5>
          <a href="http://moviematch.com/movie-detail/<?= $film->getID() ?>" class="btn btn-primary assessments-btn">Mais Detalhes</a>
          <form action="http://moviematch.com/assessments" method="POST">
            <input type="hidden" name="film_id" value="<?= $film->getId() ?>">
            <button class="btn btn-danger assessments-btn">Remover avaliação</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
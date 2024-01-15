<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>

<body>
  <div id="filmDetail-container" style="background-image: url('<?= $tmdb->getBackground($movie->getBackgroundPath()); ?>');">
    <div id="filmDetail-content">
      <div id="filmDetail-image-container">
        <img src="<?= $tmdb->getImage($movie->getImagePath()); ?>" alt="Pôster <?= $movie->getTitle() ?>" id="filmDetail-img">
        <?php foreach ($movie->getStreamings() as $streaming) : ?>
          <div class="filmDetail-container-streamings">
            <img src="<?= $tmdb->getImage($streaming->logo_path); ?>" alt="Logo <?= $streaming->provider_name ?>" class="filmDetail-logo-streaming">
            <span><?= $streaming->provider_name ?></span>
          </div>
        <?php endforeach; ?>
        <?php if (empty($movie->getStreamings())) : ?>
          <div class="filmDetail-container-streamings">
            <span><?= "Não disponível em serviços de streaming!" ?></span>
          </div>
        <?php endif; ?>
      </div>
      <div id="filmDetail-info-container">
        <h1><strong><?= $movie->getTitle() ?></strong> <span id="filmDetail-title-year">&lpar;<?= $movie->getYear() ?>&rpar;</span></h1>
        <p>
          <span>
            <strong>Lançamento: </strong>
            <?= $movie->formatDate() ?>
          </span>
          <span>&#45;</span>
          <span>
            <strong>Gêneros: </strong>
            <?= $movie->extractGenres() ?>
          </span>
        </p>
        <p>
          <strong>Avaliação dos usuários: </strong>
          <?= $movie->ratingPercentage() ?>%
        </p>
        <p id="filmDetail-tagline"><?= $movie->getTagline() ?></p>
        <h4>Sinopse</h4>
        <p><?= $movie->getOverview() ?></p>
        <form action="http://moviematch.com/movie-detail" method="POST" id="filmDetail-btn-container">
          <input type="hidden" name="film_id" value="<?= $movie->getId() ?>">
          <input type="hidden" name="film_overview" value="<?= htmlspecialchars($movie->getOverview()) ?>">
          <button type="submit" name="liked" class="filmDetail-btn" id="filmDetail-btnLiked">Gostei</button>
          <button type="submit" name="notLiked" class="filmDetail-btn" id="filmDetail-btnNotLiked">Não Gostei</button>
        </form>
      </div>
    </div>
  </div>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php require_once __DIR__ . "/../layout/navbar.php"; ?>
<?php require_once __DIR__ . "/../../utils/translateGenres.php"; ?>

<div id="modalGenre-container">
  <h1 id="modalGenre-title">Avalie os gêneros abaixo para prosseguir</h1>
  <form method="POST" id="modalGenre-form">
    <?php foreach ($genres as $genre) : ?>
      <div id="modalGenre-form-div">
        <h5><?= translateGenres($genre) ?></h5>
        <div>
          <?php for ($grade = 0; $grade < 11; $grade++) : ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="<?= $genre ?>" id="<?= $genre ?><?= $grade ?>" value="<?= $grade ?>" required>
              <label class="form-check-label" for="<?= $genre ?><?= $grade ?>"><?= $grade ?></label>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary" name="genres-assessments">Enviar</button>
  </form>
</div>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
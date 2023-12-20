<?php require_once __DIR__ . "/../layout/header.html"; ?>
<?php

require_once __DIR__ . "/../../utils/translateGenres.php";

$generos = [
  "Action",
  "Adventure",
  "Animation",
  "Comedy",
  "Crime",
  "Documentary",
  "Drama",
  "Family",
  "Fantasy",
  "History",
  "Horror",
  "Music",
  "Mystery",
  "Romance",
  "Science Fiction",
  "TV Movie",
  "Thriller",
  "War",
  "Western"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $notas = [];

  foreach ($generos as $genero) {
    if (isset($_POST[$genero])) {
      $nota = $_POST[$genero];
      $notas[$genero] = $nota;
      echo "Gênero: " . translateGenres($genero) . ", Nota: $nota<br>";
    }
  }
}
?>
<div id="modalGenre-container">
  <form method="POST" id="modalGenre-form">
    <?php foreach ($generos as $genero) : ?>
      <div>
        <span><?= translateGenres($genero) ?></span>
        <?php for ($nota = 0; $nota <= 10; $nota++) : ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="<?= $genero ?>" id="<?= $genero ?><?= $nota ?>" value="<?= $nota ?>" required>
            <label class="form-check-label" for="<?= $genero ?><?= $nota ?>"><?= $nota ?></label>
          </div>
        <?php endfor; ?>
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary" name="genres-assessments">Enviar</button>
  </form>
</div>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
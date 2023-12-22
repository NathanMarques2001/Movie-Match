<?php require_once __DIR__ . "/../layout/header.html";

use MovieMatch\Services\Connection; ?>
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

$dbGenres = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $connection = new Connection();
  $connection = $connection->createConnection();

  $query = "SELECT * FROM genres;";

  $stmt = $connection->prepare($query);

  if ($stmt->execute()) {
    $genres = $stmt->fetchAll();
    if ($genres) {
      foreach ($genres as $genre) {
        $dbGenres[$genre["name"]] = $genre["id"];
      }
    }
  }

  if (!isset($_SESSION)) {
    session_start();
  }

  foreach ($generos as $genero) {
    if (isset($_POST[$genero])) {
      $nota = $_POST[$genero];
      $query = "INSERT IGNORE INTO genre_assessment (id_user, id_genre, grade) VALUES (?, ?, ?);";

      $stmt2 = $connection->prepare($query);
      $stmt2->bindValue(1, $_SESSION["id"]);
      $stmt2->bindValue(2, $dbGenres[$genero]);
      $stmt2->bindValue(3, $nota);

      $stmt2->execute();
    }
  }

  header('Location: /home');
}
?>
<div id="modalGenre-container">
  <h1 id="modalGenre-title">Avalie os gêneros abaixo para prosseguir</h1>
  <form method="POST" id="modalGenre-form">
    <?php foreach ($generos as $genero) : ?>
      <div id="modalGenre-form-div">
        <h5><?= translateGenres($genero) ?></h5>
        <div>
          <?php for ($nota = 0; $nota <= 10; $nota++) : ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="<?= $genero ?>" id="<?= $genero ?><?= $nota ?>" value="<?= $nota ?>" required>
              <label class="form-check-label" for="<?= $genero ?><?= $nota ?>"><?= $nota ?></label>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary" name="genres-assessments">Enviar</button>
  </form>
</div>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
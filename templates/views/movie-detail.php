<?php

use MovieMatch\Controllers\FilmController;
use MovieMatch\Models\FilmDatabase;
use MovieMatch\Models\TMDBService;

require_once __DIR__ . "/../../templates/layout/header.html"; ?>
<?php require_once __DIR__ . "/../../templates/layout/navbar.php"; ?>

<body>
  <?php $a = new FilmController(new TMDBService, new FilmDatabase);
  $a->render(); ?>
</body>

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
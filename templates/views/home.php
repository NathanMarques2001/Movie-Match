<?php

use MovieMatch\Controllers\HomeController;

 require_once __DIR__ . "/../../templates/layout/header.html"; ?>
<?php require_once __DIR__ . "/../../templates/layout/navbar.php"; ?>

<body>
  <?php $a = new HomeController(); 
  $a->index();
  ?>
</body>

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
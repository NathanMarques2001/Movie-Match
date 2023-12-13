<?php require_once __DIR__ . "/../../templates/layout/header.html"; ?>
<?php require_once __DIR__ . "/../../templates/layout/navbar.html"; ?>

<body>
  <h1>Bem vindo,
    <?php echo $_SESSION['name'] ?>!
  </h1>
</body>

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
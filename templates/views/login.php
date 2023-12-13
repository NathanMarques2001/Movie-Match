<?php require_once __DIR__ . "/../../templates/layout/header.html"; ?>

<body>
  <form action="" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password">
    <button type="submit" name="Login">Entrar</button>
  </form>
</body>

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
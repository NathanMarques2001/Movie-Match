<?php require_once __DIR__ . "/../../templates/layout/header.html"; ?>

<body id="login-container">
  <form action="" method="POST" id="login-form" class="bg-light">
    <div class="mb-3" id="login-div-logo-title">
      <img src="http://moviematch.com/assets/logo.png" alt="Logo">
      <p>
        Movie <br> Match
      </p>
    </div>
    <div class="form-floating mb-3 login-form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email">
      <label for="floatingInput">Endereço de e-mail</label>
    </div>
    <div class="form-floating mb-3 login-form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="password">
      <label for="floatingPassword">Senha</label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg mb-3" name="Login" id="login-btn-entrar">Entrar</button>
    <p><a class="link-offset-2 link-underline link-underline-opacity-100" href="http://moviematch.com/signup">Criar Conta</a></p>
  </form>
</body>

<?php require_once __DIR__ . "/../../templates/layout/footer.html"; ?>
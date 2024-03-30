<?php require_once __DIR__ . "/../layout/header.html"; ?>

<body id="login-container">
  <form action="http://moviematch.com/" method="POST" id="login-form" class="bg-light">
    <div class="mb-2" id="login-div-logo-title">
      <img src="http://moviematch.com/assets/login-logo.png" alt="Logo">
      <p>
        Movie <br> Match
      </p>
    </div>
    <div class="form-floating login-form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email">
      <label for="floatingInput">Endereço de e-mail</label>
      <div class="error-message"></div>
    </div>
    <div class="form-floating mt-2 login-form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="password">
      <label for="floatingPassword">Senha</label>
      <div class="error-message"></div>
    </div>
    <button type="submit" class="btn btn-dark btn-lg mb-2 mt-3" name="Login" id="login-btn-entrar">Entrar</button>
    <p><a class="link-offset-2 link-underline link-underline-opacity-100" href="http://moviematch.com/signup">Criar Conta</a></p>
  </form>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
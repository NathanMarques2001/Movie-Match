<?php require_once __DIR__ . "/../layout/header.html"; ?>

<body id="login-container">
  <form action="http://moviematch.com/signup" method="POST" id="signup-form" class="bg-light">
    <div class="mb-1" id="login-div-logo-title">
      <img src="http://moviematch.com/assets/login-logo.png" alt="Logo">
      <p>
        Movie <br> Match
      </p>
    </div>
    <div class="form-floating login-form-floating">
      <input type="text" class="form-control" id="nameInput" placeholder="nome exemplo" name="name">
      <label for="nameInput">Nome</label>
      <div class="error-message"></div>
    </div>
    <div class="form-floating mt-2 login-form-floating">
      <input type="email" class="form-control" id="emailInput" placeholder="nome@exemplo.com" name="email">
      <label for="emailInput">Endereço de e-mail</label>
      <div class="error-message"></div>
    </div>
    <div class="form-floating mt-2 login-form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="password">
      <label for="floatingPassword">Senha</label>
      <div class="error-message"></div>
    </div>
    <button type="submit" class="btn btn-dark btn-lg mb-2 mt-3" name="Signup" id="login-btn-entrar">Cadastra-se</button>
    <p><a class="link-offset-2 link-underline link-underline-opacity-100" href="http://moviematch.com">Voltar ao login</a></p>
  </form>
</body>

<?php require_once __DIR__ . "/../layout/footer.html"; ?>
<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Authenticate;

class LoginController
{
  private Authenticate $auth;

  public function __construct()
  {
    $this->auth = new Authenticate();
  }

  public function renderLoginPage(): void
  {
    require_once __DIR__ . '/../Views/login.php';
  }

  public function processLogin(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtenha os dados do formulário
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      // Chame o método de login do serviço de autenticação
      if ($this->auth->login($email, $password)) {
        require_once __DIR__ . '/../Views/home.php';
      }
    }
  }
}

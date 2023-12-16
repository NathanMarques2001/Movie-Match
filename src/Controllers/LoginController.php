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
    require_once __DIR__ . '/../../templates/views/login.php';
  }

  public function processLogin(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtenha os dados do formulário
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $login = $this->auth->login($email, $password);

      if ($login !== false) {
        if (!isset($_SESSION)) {
          session_start();
        }

        $_SESSION['id'] = $login['id'];
        $_SESSION['name'] = $login['name'];
        $_SESSION['currentPage'] = 1;

        header('Location: /home');
      }
    }
  }
}

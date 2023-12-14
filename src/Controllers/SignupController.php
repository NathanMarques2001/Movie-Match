<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Authenticate;

class SignupController
{
  private Authenticate $auth;

  public function __construct()
  {
    $this->auth = new Authenticate();
  }

  public function renderSignupPage(): void
  {
    require_once __DIR__ . '/../../templates/views/signup.php';
  }

  public function processSignup(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtenha os dados do formulário
      $name = $_POST['name'] ?? '';
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($this->auth->signup($name, $email, $password)) {
        $login = $this->auth->login($email, $password);

        if ($login !== false) {
          if (!isset($_SESSION)) {
            session_start();
          }

          $_SESSION['id'] = $login['id'];
          $_SESSION['name'] = $login['name'];

          header('Location: /home');
        }
      }
    }
  }
}

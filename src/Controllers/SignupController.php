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

  public function processLogin(): void
  {
    // Criar conta
  }
}

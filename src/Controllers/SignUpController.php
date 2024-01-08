<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\UserDatabase;

class SignUpController extends Controller
{
  private UserDatabase $userDatabase;

  public function __construct(UserDatabase $userDatabase)
  {
    $this->userDatabase = $userDatabase;
  }

  public function render()
  {
    return $this->view("signup");
  }

  public function request()
  {
    try {
      $name = $_POST['name'] ?? '';
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($this->userDatabase->registerUser($name, $email, $password)) {
        header('Location: /');
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }
}

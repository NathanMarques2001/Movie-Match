<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\UserDatabase;

class SignUpController extends Controller
{
  public function render()
  {
    return $this->view("signup");
  }

  public function request()
  {
    $userDatabase = new UserDatabase(new Database());
    try {
      $name = $_POST['name'] ?? '';
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($userDatabase->registerUser($name, $email, $password)) {
        header('Location: /');
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }
}

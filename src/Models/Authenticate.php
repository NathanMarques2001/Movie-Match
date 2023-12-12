<?php

namespace MovieMatch\Models;

use MovieMatch\Services\Connection;
use PDO;

class Authenticate
{
  private PDO $connection;

  public function __construct()
  {
    $connection = new Connection();
    $this->connection = $connection->createConnection();
  }

  public function login(string $email, string $password)
  {
    if (strlen($email) > 0 && strlen($password) > 0) {
      $query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1;";

      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(1, $email);
      $stmt->bindValue(2, $password);

      if ($stmt->execute()) {
        $user = $stmt->fetch();
        if ($user) {
          if (!isset($_SESSION)) {
            session_start();
          }

          $_SESSION['id'] = $user['id'];
          $_SESSION['name'] = $user['name'];

          return true;
        } else {
          return false;
        }
      }
    } else {
      echo 'Usuário e senha devem ser preenchidos';
    }
    return false;
  }

  public function logout()
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    session_destroy();

    header("Location: /");
  }

  public function protect()
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (!isset($_SESSION['id'])) {
      header('Location: ../Views/login.php');
    }
  }
}

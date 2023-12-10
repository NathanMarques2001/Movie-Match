<?php

namespace MovieMatch\Services;

use PDO;

class Auth
{
  private PDO $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
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

          header('location: ../Views/home.php');
        } else {
          echo "Usuário não cadastrado";
        }
      }
    } else {
      echo 'Usuário e senha devem ser preenchidos';
    }
  }

  public function logout()
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    session_destroy();

    header("Location: ../Views/login.php");
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

  public function sessionExists()
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_SESSION['id'])) {
      header('location: ../Views/home.php');
    }
  }
}

<?php

namespace MovieMatch\Models;

use MovieMatch\Services\Connection;
use PDO;

class Database
{
  private PDO $connection;

  public function __construct()
  {
    $connection = new Connection();
    $this->connection = $connection->createConnection();
  }

  public function login(string $email, string $password)
  {
    if (empty($email) || empty(trim($password))) {
      echo 'Nome e senha devem ser preenchidos!';
      return false;
    }

    $query = "SELECT * FROM users WHERE email = ? LIMIT 1;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $email);

    if ($stmt->execute()) {
      $user = $stmt->fetch();
      if ($user) {
        if (password_verify($password, $user['password'])) {
          return $user;
        } else {
          echo "Email ou senha incorretos!";
          return false;
        }
      }
      echo "Usuário não encontrado!";
      return false;
    }
  }

  public function logout()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    session_destroy();
  }

  public function signup(string $name, string $email, string $password)
  {
    if (empty($name) || empty($email) || empty(trim($password))) {
      echo 'Nome, email e senha devem ser preenchidos!';
      return false;
    }

    if ($this->checkEmail($email)) {
      echo "Email já cadastrado!";
      return false;
    }

    $query = "INSERT INTO users (name, email, password) VALUES (?,?,?)";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
      return true;
    }

    echo 'Erro ao cadastrar usuário!';
    return false;
  }

  private function checkEmail(string $email)
  {
    $query = "SELECT * FROM users WHERE email = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $email);

    if ($stmt->execute()) {
      $user = $stmt->fetch();
      if ($user) {
        return true;
      }
      return false;
    }
  }

  public function checkGenreAssessment(int $id)
  {
    $query = "SELECT * FROM genre_assessment WHERE id_user = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $id);
    if ($stmt->execute()) {
      $genres = $stmt->fetchAll();
      if ($genres) {
        return true;
      }
      return false;
    }
  }

  public function getGenres()
  {
    $query = "SELECT * FROM genres;";

    $stmt = $this->connection->prepare($query);

    if ($stmt->execute()) {
      return $stmt->fetchAll();
    }
    return [];
  }

  public function createGenresAssessments(int $userId, int $genreID, int $grade)
  {
    $query = "INSERT IGNORE INTO genre_assessment (id_user, id_genre, grade) VALUES (?, ?, ?);";

    $stmt2 = $this->connection->prepare($query);
    $stmt2->bindValue(1, $userId);
    $stmt2->bindValue(2, $genreID);
    $stmt2->bindValue(3, $grade);

    if ($stmt2->execute()) {
      return true;
    }
    return false;
  }
}

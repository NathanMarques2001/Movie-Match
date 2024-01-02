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
          throw new \Exception("Email ou senha incorretos!");
        }
      }
      throw new \Exception("Usuário não encontrado!");
    }
    throw new \Exception("Erro na execução da consulta.");
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
      throw new \Exception("Nome, email e senha devem ser preenchidos!");
    }

    if ($this->checkEmail($email)) {
      throw new \Exception("Email já cadastrado!");
    }

    $query = "INSERT INTO users (name, email, password) VALUES (?,?,?)";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
      return true;
    }
    throw new \Exception("Erro na criação do registro.");
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
    throw new \Exception("Erro na execução da consulta.");
  }

  public function checkGenreAssessment(int $userId)
  {
    $query = "SELECT * FROM genre_assessment WHERE id_user = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $userId);
    if ($stmt->execute()) {
      $genres = $stmt->fetchAll();
      if ($genres) {
        return true;
      }
      return false;
    }
    throw new \Exception("Erro na execução da consulta.");
  }

  public function getGenres()
  {
    $query = "SELECT * FROM genres;";

    $stmt = $this->connection->prepare($query);

    if ($stmt->execute()) {
      return $stmt->fetchAll();
    }
    throw new \Exception("Erro na execução da consulta.");
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
    throw new \Exception("Erro na criação do registro.");
  }

  public function getGenreAssessment(int $userId)
  {
    $query = "SELECT * FROM genre_assessment WHERE id_user = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $userId);
    if ($stmt->execute()) {
      $genres = $stmt->fetchAll();
      if ($genres) {
        return $genres;
      }
      return [];
    }
    throw new \Exception("Erro na execução da consulta.");
  }

  public function getRatedFilms(int $userId)
  {
    $query = "SELECT * FROM rated_films WHERE id_user = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $userId);
    if ($stmt->execute()) {
      $films = $stmt->fetchAll();
      if ($films) {
        return $films;
      }
      return [];
    }
    throw new \Exception("Erro na execução da consulta.");
  }

  public function rateFilm(int $userId, int $filmId, string $overview, int $rated)
  {
    $query = "INSERT INTO rated_films (id_user, id_film, overview, rated) VALUES (?,?,?,?)";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $userId);
    $stmt->bindValue(2, $filmId);
    $stmt->bindValue(3, $overview);
    $stmt->bindValue(4, $rated);

    if ($stmt->execute()) {
      return true;
    }
    throw new \Exception("Erro ao avaliar filme!");
  }
}

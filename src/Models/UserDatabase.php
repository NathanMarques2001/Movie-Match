<?php

namespace MovieMatch\Models;

use PDO;

class UserDatabase
{
  private Database $database;
  private PDO $connection;

  public function __construct(Database $database)
  {
    $this->database = $database;
    $this->connection = $this->database->getConnection();
  }

  public function findUser(string $email, string $password)
  {
    if (empty($email) || empty(trim($password))) {
      throw new \Exception("Email e senha devem ser preenchidos!");
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

  public function registerUser(string $name, string $email, string $password)
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

  public function getMovieList(int $userId)
  {
    $query = "SELECT * FROM user_list WHERE id_user = ?;";

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

  public function addMovieToList(int $userId, int $movieId)
  {
    $query = "INSERT INTO user_list (id_user, id_film) VALUES (?,?)";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $userId);
    $stmt->bindValue(2, $movieId);

    if ($stmt->execute()) {
      return true;
    }
    throw new \Exception("Erro na criação do registro.");
  }
}

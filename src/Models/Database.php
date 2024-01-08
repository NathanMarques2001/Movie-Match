<?php

namespace MovieMatch\Models;

use Dotenv\Dotenv;
use PDO;

class Database
{
  private PDO $connection;

  public function __construct()
  {
    $this->connection = $this->createConnection();
  }

  public function getConnection()
  {
    return $this->connection;
  }

  private static function createConnection()
  {
    $path = dirname(__DIR__, 2);
    $dotenv = Dotenv::createImmutable($path);
    $dotenv->load();

    $connection = new PDO(
      'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
      $_ENV['DB_USER'],
      $_ENV['DB_PASS']
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $persistence = file_get_contents(__DIR__ . "/../../utils/script.sql");

    $connection->exec($persistence);

    return $connection;
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
}

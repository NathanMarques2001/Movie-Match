<?php

namespace MovieMatch\Models;

use PDO;

class GenreDatabase
{
  private Database $database;
  private PDO $connection;

  public function __construct()
  {
    $this->database = new Database();
    $this->connection = $this->database->getConnection();
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
}

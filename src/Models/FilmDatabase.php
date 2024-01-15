<?php

namespace MovieMatch\Models;

use PDO;

class FilmDatabase
{
  private Database $database;
  private PDO $connection;

  public function __construct(Database $database)
  {
    $this->database = $database;
    $this->connection = $this->database->getConnection();
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

  public function removeFromList(int $filmID)
  {
    $query = "DELETE FROM user_list WHERE id_film = ?;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindValue(1, $filmID);
    if ($stmt->execute()) {
      return true;
    }
    throw new \Exception("Erro ao retirar da lista!");
  }
}

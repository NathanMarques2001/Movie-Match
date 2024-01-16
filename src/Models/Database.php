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
}

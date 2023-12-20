<?php

namespace MovieMatch\Services;

use Dotenv\Dotenv;
use PDO;

class Connection
{
  public static function createConnection()
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

    $persistence = file_get_contents(__DIR__ . "/script.sql");

    $connection->exec($persistence);

    return $connection;
  }
}

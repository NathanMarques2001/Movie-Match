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
      $_ENV['DB_PASSWORD']
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $connection;
  }
}

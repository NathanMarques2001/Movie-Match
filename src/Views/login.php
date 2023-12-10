<?php

require_once "../../vendor/autoload.php";

use MovieMatch\Services\Auth;
use MovieMatch\Services\Connection;

$connection = new Connection();
$auth = new Auth($connection->createConnection());

$auth->sessionExists();

if (isset($_POST['email']) && isset($_POST['password'])) {
  $auth->login($_POST['email'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password">
    <button type="submit">Entrar</button>
  </form>
</body>

</html>
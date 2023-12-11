<?php

// require_once __DIR__ . "/../../vendor/autoload.php";

// use MovieMatch\Services\Auth;
// use MovieMatch\Services\Connection;

// if (!isset($_SESSION)) {
//   session_start();
// }

// $connection = new Connection();
// $auth = new Auth($connection->createConnection());

// //$auth->protect();

// if (isset($_GET['logout'])) {
//   $auth->logout();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Bem vindo,
    <?php echo $_SESSION['name'] ?>!
  </h1>

  <!-- <a href="?logout=true">Sair</a> -->
</body>

</html>
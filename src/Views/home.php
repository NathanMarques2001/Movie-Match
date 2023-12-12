<?php

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

  <form action="" method="POST">
    <button>Sair</button>
  </form>
</body>

</html>
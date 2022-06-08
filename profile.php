<?php
session_start();

if(!$_SESSION['user']) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatuble" content="ie=edge">

    <link rel="stylesheet" href="css/auth.scss">

    <title>Профиль</title>
</head>
<body>
<div>
    <form action="signup.php" method="post">
      <h2> <?= $_SESSION['user']['fullname'] ?> </h2>
        <h3>id = <?= $_SESSION['user']['id']?></h3>
        <a href=""> <h2> <?= $_SESSION['user']['email'] ?> </h2></a>
        <a href="logout.php" class = 'logout'>Выйти</a>
    </form>
</div>
</body>
</html>
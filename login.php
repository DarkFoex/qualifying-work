<?php
session_start();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatuble" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.svg" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/auth.scss">

    <title>Регистрация</title>
</head>
<body>
<?php require "blocks/header_adm.php"; ?>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<div>
    <form action="signin.php" method="post">
        <h3>Вход</h3>
        <label for=""> Логин</label>
        <input type="text" class="input__label" name="login" placeholder="Введите логин">
        <label for="">Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <label>У вас нет аккаунта ? - <a class="text-decoration-none" href="register.php">зарегистрируйтесь</a></label>

    </form>
</div>
</body>
</html>




<?php
session_start();

if($_SESSION['user']) {
    header('Location: profile.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
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
    <form action="signup.php" method="post">
        <?php
        if($_SESSION['message'])
        {
            echo '<h5 class="bg-success p-2 text-dark border border-warning bg-opacity-10 "> '. $_SESSION['message'] .' </h5>';
        }
        unset($_SESSION['message']);
        ?>
        <label for=""> ФИО</label>
        <input type="text" name="fullname" required  placeholder="Введите полное имя">
        <label for=""> Логин</label>
        <input type="text" name="login" required placeholder="Введите логин">
        <label for=""> Почта</label>
        <input type="email" name="email" required placeholder="Введите адрес почты">
        <label for="">Пароль</label>
        <input type="password" name="password" required placeholder="Введите пароль">
        <label for="">Подтвердите пароль</label>
        <input type="password" name="password_confirm" required placeholder="Подтвердите пароль">
        <button type="submit">Зарегистрироваться</button>
        <label>У вас уже есть аккаунта ? - <a href="login.php">авторизируйтесь</a></label>


    </form>
</div>
</body>
</html>
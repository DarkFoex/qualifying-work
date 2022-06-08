<?php
session_start();
$users = mysqli_connect('localhost','root','root','users','3306');
$fullname = $_POST['fullname'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password == $password_confirm) {
    if (strlen($password) >= 8) {
        $password = md5($password);
        $usr = mysqli_query($users, "SELECT * from users where login =  '{$login}'");
        $row = mysqli_fetch_assoc($usr);
        if ($row['login'] == '') {
            $eml = mysqli_query($users, "SELECT * from users where email =  '{$email}'");
            $row_eml = mysqli_fetch_assoc($eml);
            if ($row_eml['email'] == '') {
                mysqli_query($users, "INSERT INTO `users` ( `fullname`, `login`, `password`, `email`) VALUES ( '$fullname', '$login', '$password', '$email') ");
                $_SESSION['message'] = 'Регистрация прошла успешно!';
                header('Location: login.php');
            } else {
                $_SESSION['message'] = 'Пользователь с таким email уже существует';
                header('Location: register.php');
            }
        } else {
            $_SESSION['message'] = 'Пользователь с таким логином уже существует';
            header('Location: register.php');
        }
    } else {
        $_SESSION['message'] = 'Пароль должен содержать минимум 8 символов';
        header('Location: register.php');
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: register.php');
}
?>
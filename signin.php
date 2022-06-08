<?php
session_start();
$users = mysqli_connect('localhost','root','root','users','3306');

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($users, "SELECT * FROM `users` WHERE `login` = '$login' and `password` = '$password'; ");
if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    if ($user['is_blocked'] != '1') {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "fullname" => $user['fullname'],
            "email" => $user['email'],
            "is_admin" => $user['is_admin'],
            "is_blocked" => $user['is_blocked'],
            "is_teacher" => $user['is_teacher']
        ];
        print_r($_SESSION['user']);
        header('Location: index.php');
    }
    else {
        $_SESSION['message'] = 'Данный пользователь заблокирован в системе!';
        header('Location: login.php');
    }
} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: login.php');
}
?>
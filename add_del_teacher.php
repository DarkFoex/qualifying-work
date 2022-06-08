<?php

$user_db = mysqli_connect('localhost', 'root', 'root', 'users', '3306');
session_start();
$id = (int)$_GET['id'];


    $res = mysqli_query($user_db, "SELECT * from users where id = '{$id}' ");
    $row = mysqli_fetch_assoc($res);
    $upd_id = $row['id'];
    if ($row['is_teacher'] == 1) {
        mysqli_query($user_db, "UPDATE users SET is_teacher = 0 WHERE id = '{$upd_id}'; ");
    } else {
        mysqli_query($user_db, "UPDATE users SET is_teacher = 1 WHERE id = '{$upd_id}'; ");
    }
    header('location: add_admin.php');
    ?>

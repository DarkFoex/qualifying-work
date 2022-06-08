<?php

$user_db = mysqli_connect('localhost', 'root', 'root', 'users', '3306');
session_start();
$id = (int)$_GET['id'];

    $res = mysqli_query($user_db, "select u.id as id,fullname,test_id,user_id,result,max_result,title from users u left join(select * from test.user_result ur) ur on u.id = ur.user_id left join(select * from test.tests) te on te.id = ur.test_id where result is not null and u.id = '${id}' order by test_id and u.id desc");
    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatuble" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.svg" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/font.css">
    <title>Электронный учебник</title>
</head>
<body>
<?php require "blocks/header.php"; ?>

<div class="container mt-5">
    <div class=" ">
        <a href="stud_stat.php" class="text-white text-decoration-none"><button class="btn btn-primary">Вернуться</button></a>
        <table class="table">
            <thead>
                <tr><th colspan="3" class="text-center">
                    <?php $res_user = mysqli_query($user_db, "select * from users where id = '{$id}'");
                        $name_row = mysqli_fetch_assoc($res_user);
                        echo $name_row['fullname']
                    ?>
                </th></tr>
                <?php for ($i = 1; $i <= 7; $i++) { 
                    $test_num = 21+$i;
                    $num_list = 1;
                    $res_user = mysqli_query($user_db, "select * from test.user_result where test_id = '${test_num}' and user_id = '${id}' ");
                        $name_row = mysqli_fetch_assoc($res_user);
                        if ($name_row['id'] != ''){
                    ?>
                <tr>
                    <th colspan="3" class="text-center">Тест <?php echo $i ?></th>
                    
                </tr>

            
            <tr>
                <th scope="col">№</th>
                <th scope="col">Название теста</th>
                <th scope="col">Баллы</th>

            </tr>
            <?php } ?>
            </thead>
            <tbody>
            <?php
            $test_num = 21+$i;
            $res = mysqli_query($user_db, "select u.id as id,ur.id as try_id,fullname,test_id,user_id,result,max_result,title,datetime_test from users u left join(select * from test.user_result ur) ur on u.id = ur.user_id left join(select * from test.tests) te on te.id = ur.test_id where result is not null and u.id = '${id}' and test_id = '${test_num}'order by datetime_test desc");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $num_list; $num_list ++; ?></td>
                    <td><a href="test_stat.php?user_id=<?php echo $id ?>&test_id=<?php echo $row['try_id'] ?>" class=" text-black"><?php echo $row['title']; ?></a></td>
                    <td><?php echo $row['result'];?> из <?php echo $row['max_result'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <?php } ?>
        </table>

    </div>

</div>
<?php require "blocks/footer_lower.php"; ?>

</body>
</html>
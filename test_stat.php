<?php

$user_db = mysqli_connect('localhost', 'root', 'root', 'users', '3306');
session_start();
$test_id = (int)$_GET['test_id'];
$user_id  = $_GET['user_id'];
    $res = mysqli_query($user_db, "select * from test.user_result ur where id = '${user_id}'");
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
<?php require "blocks/header_adm.php"; ?>

<div class="container mt-5">
    <div class=" ">
        <a href="stud_stat.php" class="text-white text-decoration-none"><button class="btn btn-primary">Вернуться</button></a>
        <table class="table">
            <thead>
                <tr><th colspan="4" class="text-center">
                    <?php $res_user = mysqli_query($user_db, "select * from users where id = '{$user_id}'");
                        $name_row = mysqli_fetch_assoc($res_user);
                        echo $name_row['fullname']
                    ?>
                </th></tr>
            </thead>
            <tbody>
                <th colspan="4" class="text-center">Правильные вопросы</th>
            <?php
            $res = mysqli_query($user_db, "select * from test.user_result ur where id = '{$test_id}'");
            $row = mysqli_fetch_assoc($res);
            $count_question = count(json_decode($row['array_result'],true));
            $question_num = 1;
            $num_list = 1;
            $res1 = mysqli_query($user_db, "select min(id) as min_id from test.question q  where test_id in (select test_id  from test.user_result ur where id = '{$test_id}')");
            $row1 = mysqli_fetch_assoc($res1);
            $min_id = $row1['min_id'];
            while ($question_num <= $count_question) {
                $quest_id = $min_id + $question_num - 1;
                $question_row = mysqli_query($user_db,"select * from test.question q where id = '${quest_id}'");
                $question_res = mysqli_fetch_assoc($question_row);
                if (json_decode($row['array_result'],true)[$question_num] == 1) {?>
                <tr>
                    <td><?php echo $num_list; $num_list ++; ?></td>
<!--                     <td><?php echo json_decode($row['array_result'],true)[$question_num]; ?> </td> -->
                    <td class="h6"><?php echo $question_res['question'];?></td>
                </tr>
                <?php } 

                $question_num++; } ?>
                <th colspan="4" class="text-center">Неправильные вопросы</th>
            <?php
            $res = mysqli_query($user_db, "select * from test.user_result ur where id = '{$test_id}'");
            $row = mysqli_fetch_assoc($res);
            $count_question = count(json_decode($row['array_result'],true));
            $question_num = 1;
            $num_list = 1;
            $res1 = mysqli_query($user_db, "select min(id) as min_id from test.question q  where test_id in (select test_id  from test.user_result ur where id = '{$test_id}')");
            $row1 = mysqli_fetch_assoc($res1);
            $min_id = $row1['min_id'];
            while ($question_num <= $count_question) {
                $quest_id = $min_id + $question_num - 1;
                $question_row = mysqli_query($user_db,"select * from test.question q where id = '${quest_id}'");
                $question_res = mysqli_fetch_assoc($question_row);
                if (json_decode($row['array_result'],true)[$question_num] != 1) {?>
                <tr>
                    <td><?php echo $num_list; $num_list ++; ?></td>
<!--                     <td><?php echo json_decode($row['array_result'],true)[$question_num]; ?> </td> -->
                    <td class="h6"><?php echo $question_res['question'];?></td>
                </tr>
                <?php } 

                $question_num++; } ?>
            </tbody>
        </table>

    </div>

</div>
<?php require "blocks/footer.php"; ?>

</body>
</html>
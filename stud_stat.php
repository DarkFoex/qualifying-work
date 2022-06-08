<?php
$user_db = mysqli_connect('localhost', 'root', 'root', 'users', '3306');

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
        <a href="index.php" class="text-white text-decoration-none"><button class="btn btn-primary">Вернуться</button></a>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th colspan="7" class="text-center">Попытки</th>
            </tr>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Логин</th>
                <th scope="col">Тест 1</th>
                <th scope="col">Тест 2</th>
                <th scope="col">Тест 3</th>
                <th scope="col">Тест 4</th>
                <th scope="col">Тест 5</th>
                <th scope="col">Тест 6</th>
                <th scope="col">Тест 7</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $res = mysqli_query($user_db, "select id,fullname,login,sum(test1) as test1,sum(test2) as test2 ,sum(test3) as test3 ,sum(test4) as test4,sum(test5) as test4,sum(test6) as test6,sum(test7) as test7 from (select u.id as id,fullname,login, case when test_id = 22 then count(result) end as test1, case when test_id = 23 then count(result) end as test2,case when test_id = 24 then count(result) end as test3, case when test_id = 25 then count(result) end as test4, case when test_id = 26 then count(result) end as test5, case when test_id = 27 then count(result) end as test6, case when test_id = 28 then count(result) end as test7,  user_id,count(result) from users u left join(select * from test.user_result ur) ur on u.id = ur.user_id left join(select * from test.tests) te on te.id = ur.test_id where result is not null group by u.id,fullname,test_id,user_id order by test_id and u.id desc) a group by fullname,login,id");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>            
                <tr>
                    <td id=name><a class="text-decoration-underline text-dark" href="user_stat.php?id=<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?></a></td>
                    <td><?php echo $row['login']; ?></td>
                    <td><?php echo $row['test1']; ?></td>
                    <td><?php echo $row['test2']; ?></td>
                    <td><?php echo $row['test3']; ?></td>
                    <td><?php echo $row['test4']; ?></td>
                    <td><?php echo $row['test5']; ?></td>
                    <td><?php echo $row['test6']; ?></td>
                    <td><?php echo $row['test7']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

</div>
<?php require "blocks/footer_lower.php"; ?>

</body>
</html>
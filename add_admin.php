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
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Логин</th>
                <th scope="col">Email</th>
                <th scope="col">Добавить/удалить права</th>
                <th scope="col">Статус блокировки</th>
                <th scope="col">Добавить/удалить учителя</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $res = mysqli_query($user_db, "SELECT * from users ");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td id=name><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['login']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <?php if ($row['is_admin'] == 1) { ?>
                        <td><a class="text-black" href="add_del_adm.php?id=<?php echo $row['id']; ?>"><i
                                        class="bi bi-dash-circle-dotted" style="font-size: 1.5rem;"></i></a></td>
                    <?php } else { ?>
                    <td><a class="text-black" href="add_del_adm.php?id=<?php echo $row['id']; ?>"><i
                                    class="bi bi-plus-circle-dotted" style="font-size: 1.5rem;"></i></a> <?php } ?>
                        <?php if ($row['is_blocked'] != 1) { ?>
                    <td><a class="text-black" href="block_user.php?id=<?php echo $row['id']; ?>"><i
                                    class="bi bi-dash-circle-dotted" style="font-size: 1.5rem;"></i></a></td>
                    <?php } else { ?>
                    <td><a class="text-black" href="block_user.php?id=<?php echo $row['id']; ?>"><i
                                    class="bi bi-plus-circle-dotted" style="font-size: 1.5rem;"></i></a> <?php } ?>
                
            
                        <?php if ($row['is_teacher'] == 1) { ?>
                        <td><a class="text-black" href="add_del_teacher.php?id=<?php echo $row['id']; ?>"><i
                                        class="bi bi-dash-circle-dotted" style="font-size: 1.5rem;"></i></a></td>
                    <?php } else { ?>
                    <td><a class="text-black" href="add_del_teacher.php?id=<?php echo $row['id']; ?>"><i
                                    class="bi bi-plus-circle-dotted" style="font-size: 1.5rem;"></i></a> <?php } ?></td>
                                    </tr>
                                    <?php } ?>
            </tbody>
        </table>

    </div>

</div>
<?php require "blocks/footer_lower.php"; ?>

</body>
</html>
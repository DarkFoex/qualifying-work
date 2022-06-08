<?php
$text_db = mysqli_connect('localhost', 'root', 'root', 'text_info', '3306');
$db = mysqli_connect('localhost', 'root', 'root', 'test', '3306');
$user_db = mysqli_connect('localhost', 'root', 'root', 'users', '3306');
session_start();
$id = (int)$_GET['id'];

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
    <link rel="stylesheet" href="css/font.css">

    <title>Электронный учебник</title>
</head>
<body>
<?php require "blocks/header_adm.php"; ?>
<?php
$res = mysqli_query($text_db, "SELECT count(distinct title) as cnt_title,count(distinct subtitle) as cnt_subtitle FROM text ");
$row = mysqli_fetch_assoc($res);
?>


<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Администрирование</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon bg-success bg-gradient d-flex ">
                <img class="me-2 mt-2" src="img/test.svg"
                     height="50"
                     alt="image format png"/>
                <h2 class="text-white">Добавление новых тестов</h2>
            </div>
            <h5>Добавить новый тест, с необходимым количеством вопрос, возможных ответов и различным выводом результата
                .</h5>
            <h6 class="text-secondary">Тест появится в общем списке тестов
                .</h6>
            <a href="/test_page.php?do=add" class="icon-link text-white text-decoration-none "><button class="btn btn-primary">
                    Добавить новый тест
                </button></a>
        </div>

        <div class="feature col">
            <div class="feature-icon bg-success bg-gradient d-flex ">
                <img class="me-2 mt-2" src="img/test.svg"
                     height="50"
                     alt="image format png"/>
                <h2 class="text-white">Добавление новых глав</h2>
            </div>
            <h5>Добавить новую главу, с необходимым количеством параграфов. К каждому параграфу можно приложить картинку
                .</h5>
            <h6 class="text-secondary">Глава появится в общем списке глав
                .</h6>
            <a href="/course.php?do=add_text" class="icon-link text-white text-decoration-none "><button class="btn btn-primary">
                    Добавить новый текст
                </button></a>
        </div>


        <div class="feature col">
            <div class="feature-icon bg-success bg-gradient d-flex ">
                <img class="me-2 mt-2" src="img/test.svg"
                     height="50"
                     alt="image format png"/>
                <h2 class="text-white">Управление пользователями</h2>
            </div>
            <h5>Выдача прав администратора,блокировка пользователя.</h5>
            <h6 class="text-secondary">Пользователь с правами администратора может создавать новые тесты и главы.
                Заблокированный пользователь не может заходить в систему
                .</h6>
            <a href="/add_admin.php" class="icon-link text-white text-decoration-none "><button class="btn btn-primary">
                    Управление пользователями
                </button></a>
        </div>
    </div>
</div>

<?php require "blocks/footer_lower.php"; ?>
</body>
</html>
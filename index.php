<?php
session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'test', '3306');
$text_db = mysqli_connect('localhost', 'root', 'root', 'text_info', '3306');
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
    <link rel="stylesheet" href="css/swap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <title>Электронный учебник</title>
</head>
<body>
<?php require "blocks/header.php"; ?>

<div class="container mt-5 mb-5">
    <div class="d-flex flex-wrap">
        <div class="row justify-content-center">
            <div class="col-9">
                 <?php 
if($_SESSION['test'])
        {
            echo '<h5 class="bg-success p-2 text-dark border border-warning bg-opacity-10 "> '. $_SESSION['test'] .' </h5>';
        }
        unset($_SESSION['test']);
            ?>
            </div>
            <div class="col-6">
                <h2 style=" text-indent: 25px;">Что такое электронная форма
                        учебника?</h2>
                <h5 style=" text-indent: 25px;">В работе рассматриваются рекреационные зоны и растительность как основной элемент для оказания экосистемных услуг. В издание освещено полифункциональность растительности рекреационных зон, их многообразие, биологическое и экологическое значение в средообразовании и создании комфортных условий для населения. На примере г. Нур-Султан, в условиях Северного Казахстана показано усиление сочетания природного ландшафта, элементов озеленения, водных ресурсов в городской структуре. В учебном пособии предложены пути использования современных технологий в зеленом строительстве.</h5>
                <h5 style=" text-indent: 25px;">Предлагаемые материалы предназначены для преподавателей и студентов Вузов естественно-научного и сельскохозяйственного направлений, работников охраны природы, фитосанитарного контроля и других заинтересованных организаций.</h5>
            </div>
            <div class="col-3 text-center" >
                <img src="img/book.svg" width="80%" style="margin-top: 40%;"
                     alt="Электронный учебник 'Защита декоративных растений рекреационных зон г. Нур-Султан"/>
            </div>
        </div>
        <div class="row justify-content-center">
            <h1 class="col-9 mt-5 ms-5">Хотите продолжить изучать?</h1>
            <?php
            $res = mysqli_query($text_db, "select * from  (select distinct text_id ,title,subtitle  from `text` t ORDER BY rand() limit 6) a order by text_id");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="card col-3 mb-5 p-0">

                    <div class="card-head " style="background-color: #014530;height: 20px;"></div>
                    <a class="link-dark d-flex text-decoration-none ms-1  mt-1 ps-3"
                       href="paragr.php?id=<?php echo $row['text_id']; ?> "><img class="me-2" src="img/test.svg"
                                                                                 height="25"
                                                                                 alt="image format png"/>
                        <h5><?php echo $row['subtitle']; ?></h5>
                    </a>
                </div>
            <?php } ?>
        </div> 
    </div>

    <script src="js/swap.js"></script>
</div>
<?php require "blocks/footer.php"; ?>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/swap.js"></script>
</html>
<?php

$text_db = mysqli_connect('localhost', 'root', 'root', 'text_info', '3306');
$db = mysqli_connect('localhost','root','root','test','3306');
session_start();
$id = (int)$_GET['id'];
if ($id < 1) {
    header ('location: course.php');
}

$textId = $id;
if (!isset($_SESSION['$textId']) || $_SESSION['$textId'] != $textId) {
    $_SESSION['$textId'] = $textId;
}
$res = mysqli_query($text_db, "SELECT * FROM text WHERE text_id = '{$textId}'");
$row = mysqli_fetch_assoc($res);
$testTitle = $row['title'];
$text = $row['text'];
$lr = 0;

$text_id_prev = mysqli_query($text_db, "select max(text_id) as max from (select distinct text_id  from text ) a  WHERE text_id < '{$textId}'  ; ");
$row_prev = mysqli_fetch_assoc($text_id_prev);
$text_id_next = mysqli_query($text_db, "select min(text_id) as min from (select distinct text_id  from text ) a  WHERE text_id > '{$textId}'  ; ");
$row_next = mysqli_fetch_assoc($text_id_next);
$text_id_max = mysqli_query($text_db, "select max(text_id) as maxi from text; ");
$row_max = mysqli_fetch_assoc($text_id_max);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.svg" type="image/png">
    <title>Система тестирования</title>
    <style>
        p {
            text-indent: 20px; /* Отступ первой строки в пикселах */
        }

        tr {
            text-align: center; /* Выравниваем текст по центру ячейки */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <style>
        .leftimg {
            float:left; /* Выравнивание по левому краю */
            margin: 7px 7px 7px 0; /* Отступы вокруг картинки */
        }
        .rightimg  {
            float: right; /* Выравнивание по правому краю  */
            margin: 7px 0 7px 7px; /* Отступы вокруг картинки */
        }
    </style>
</head>
<body>
<?php require "blocks/header.php"; ?>
<div class="container">

    <h2 class="d-flex justify-content-center mt-5"><?php echo $row['subtitle']; ?></h2>
    <hr class=""/>

    <div class="mb-5">
        <?php $prev_img = '';
        $res = mysqli_query($text_db, "SELECT * FROM text WHERE text_id = '{$textId}'");
        while ($row = mysqli_fetch_assoc($res)) {
            $show_img = base64_encode($row['image']);
            ?>
        <?php if ($row['text'] == 'table1') { ?>
            <table class="table table-success table-striped   ">
                <thead>
                <tr>
                    <th scope="col">Торговое название, препаративная форма, действующее вещество, класс опасности, дата
                        перерегистрации
                    </th>
                    <th scope="col">Норма расхода препарата
                        (л/га, кг/га)
                    </th>
                    <th scope="col">Культура,
                        обрабатываемый объект
                    </th>
                    <th scope="col">Вредный
                        организм
                    </th>
                    <th scope="col">Способ, особенности применения, ограничения
                    </th>
                </tr>
                <tr>
                    <th scope="col">1</th>
                    <th scope="col">2
                    </th>
                    <th scope="col">3
                    </th>
                    <th scope="col">4
                    </th>
                    <th scope="col">5
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="5">Инсектициды и акарициды</td>
                </tr>
                <tr>
                    <td rowspan="2">АКТЕЛЛИК 500, к.э. (пиримифос-метил,500 г/л) П-1 12.2021 г.</td>
                    <td>0,5-1,5</td>
                    <td>Декоративные культуры открытого грунта</td>
                    <td>Листовертки, тли, клещи, трипсы</td>
                    <td>Опрыскивание в период вегетации, срок последней обработки за 20 дней до сбора, максимальная
                        кратность обработок – 4
                    </td>
                </tr>
                <tr>
                    <td>2,4-3,6</td>
                    <td>Декоративные культуры защищенного грунта</td>
                    <td>Белокрылка, тли, клещи, трипсы</td>
                    <td>Опрыскивание в период вегетации, срок последней обработки за 3 дня до сбора, максимальная
                        кратность обработок – 4
                    </td>
                </tr>
                <tr>
                    <td rowspan="1">ЗОЛОН 35%, к.э. (фозалон, 350 г/л) П-1 12.2024 г.</td>
                    <td>1,2</td>
                    <td>Роза эфиромасличная</td>
                    <td>Тли, клещи, листовертки, цикадки</td>
                    <td>Опрыскивание в период вегетации, срок последней обработки за 30 дней до сбора максимальная
                        кратность обработок - 1
                    </td>
                </tr>
                <tr>
                    <td rowspan="1">КАРАТЭ 050, к.э. (лямбда-цигалотрин, 50 г/л)П-112.2021 г.</td>
                    <td>0,2-0,4</td>
                    <td>Неплодоносящие сады, декоративные насаждения, лесозащитные полосы</td>
                    <td>Американская белая бабочка</td>
                    <td>Опрыскивание в период вегетации, максимальная кратность обработок - 2</td>
                </tr>
                <tr>
                    <td rowspan="1">ОМАЙТ 30%, с.п. (пропаргит, 300 г/кг) П-4 12.2022 г.</td>
                    <td>3,0</td>
                    <td>Гвоздика ремонтантная, роза</td>
                    <td>Паутинный клещ</td>
                    <td>Опрыскивание в период вегетации, срок последней обработки за 3-5 дней до сбора, максимальная
                        крат ность обработок - 1
                    </td>
                </tr>
                <tr>
                    <td colspan="5">Фунгициды</td>
                </tr>
                <tr>
                    <td rowspan="1">БАЙЛЕТОН 25%, с.п. (триадимефон, 250 г/кг) П-4 12.2022 г.</td>
                    <td>0,75</td>
                    <td>Роза защищенного грунта</td>
                    <td>Мучнистая роса</td>
                    <td>Опрыскивание в период вегетации 0.05 суспензией препарата, срок последней обработки за 5 дней до
                        сбора, максимальная кратность обработок - 1
                    </td>
                </tr>
                <tr>
                    <td rowspan="3">ПРЕВИКУР ЭНЕРДЖИ , в.к. (пропамокарб, 530 г/л + фосэтил, 310 г/л) П-4 12.2023 г.
                    </td>
                    <td>3 мл/м2</td>
                    <td>Декоративные культуры (в том числе защищенного грунта)</td>
                    <td>Прикорневые гнили</td>
                    <td>Полив грунта после посева культуры – 3 мл/2л рабочего раствора/м2, повторно через 7-10 дней,
                        максимальная кратность обработок – 2
                    </td>
                </tr>
                <tr>
                    <td>3 л/га</td>
                    <td>Декоративные культуры (в том числе защищенного грунта)</td>
                    <td>Прикорневые гнили</td>
                    <td>Полив (капельный) по вегетации культуры, максимальная кратность обработок - 2</td>
                </tr>
                <tr>
                    <td>2,5 л/га</td>
                    <td>Декоративные культуры (в том числе защищенного грунта)</td>
                    <td>Ложная мучнистая роса</td>
                    <td>Опрыскивание растений в период вегета-ции, максимальная кратность обработок - 2</td>
                </tr>
                <tr>
                    <td colspan="5">Родентициды</td>
                </tr>
                <tr>
                    <td rowspan="2">ИЗОЦИН , м.к. (изопропилфенацин, 3 г/л) 12.2020 г</td>
                    <td rowspan="2">0,006-0,12 л/га по препарату 0,3-6,0 кг/га готовой приманки</td>
                    <td rowspan="2">Склады, хранилища, защищенный грунт, хозяйственные постройки</td>
                    <td>Домовая мышь</td>
                    <td>Раскладка отравленной приманки (20 мл препарата на 1 кг зерна) в приманочные ящики, по 10 г. в
                        ящик, из расчета 4 ящика на 50 м2 площади. Поедаемые порции приманки восполняются на 8 день
                    </td>
                </tr>
                <tr>
                    <td>Домовая мышь</td>
                    <td>Раскладка отравленной приманки (20 мл препарата на 1 кг зерна) в приманочные ящики, по 20 г. в
                        ящик, из расчета 4
                    </td>
                </tr>
                <tr>
                    <td rowspan="1">КЛЕРАТ Г, 0.005% гранулы (бродифакум, 0, 05 г/кг) 12.2022 г.</td>
                    <td>0,005% в приман-ке</td>
                    <td>Склады, хранилища, защищенный грунт, хозяйственные постройки</td>
                    <td>Домовая мышь</td>
                    <td>Раскладывают по 6-8 г в приманочные ящики. Их ставят у каждого убежища как внизу, так и на
                        других уровнях в объекте. Порции восполняют в течение 2 недель
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">ШТОРМ 0.005%, восковые брикеты (флокумафен) 12.2022 г.</td>
                    <td rowspan="2">-</td>
                    <td rowspan="2">Склады, хранилища, погреба, защищенный грунт, хозяйственные постройки</td>
                    <td>Домовая мышь</td>
                    <td>Раскладка по 0.3-0.5 брикета в каждый приманочный
                        ящик. Их ставят как внизу, так и на других уровнях в объекте. Минимальное расстояние между
                        точками 2 м. Поедаемую приманку восполняют до 3 раз в течение 2 недель
                    </td>
                </tr>
                <tr>
                    <td>Серая крыса</td>
                    <td>Раскладка по 2 брикета в каждый приманочный ящик. Не менее 4 в отсеке размером до 50 кв.м. В
                        более крупных помещениях и с внешней стороны объекта интервал между смежными точками 10-15 м.
                        Поедаемые порции восполняют 2 раза в течение 10 дней
                    </td>
                </tr>
                <tr>
                    <td colspan="5">Нематициды</td>
                </tr>
                <tr>
                    <td rowspan="1">НЕМАТОРИН 10, гранулы (фостиазат, 100 г/кг) 12.2022 г.</td>
                    <td>30,0</td>
                    <td>Защищенный грунт</td>
                    <td>Галловые нематоды</td>
                    <td>Однократное внесение в почву до посадки культуры, срок последней обработки за 60 дней до сбора
                    </td>
                </tr>
                </tbody>
            </table>
        <?php } ?>
        <p><?php if ($row['text'] != '.' && $row['text'] != 'table1') echo $row['text']; ?></p>
        <?php if ($show_img != null && $show_img != $prev_img) {
            ; ?>
                    <?php if ($lr == 0)
                        { ?>
            <div class="leftimg me-5">
            <img src="data:image/jpeg;base64, <?= $show_img ?>" height="400" width="600" alt=""  ">
            <p class="text-center"><?php echo $row['image_label'] ?></p> <?php $lr = 1; } else {?>
                    <div class="rightimg ms-5">
                    <img src="data:image/jpeg;base64, <?= $show_img ?>" height="400" width="600" alt=""  ">
                    <p class="text-center"><?php echo $row['image_label'] ?></p> <?php $lr = 0; } ?>
            </div><?php $prev_img = $show_img;
        } ?>


        <?php
        $show_img = 0;
        } ?>
    </div>
    <hr class=""/>
    <div class="container d-flex justify-content-between">

        <div>


            <?php if ($textId != 1) { ?>
                <a href="paragr.php?id=<?php echo $row_prev["max"]; ?>" class="btn btn-primary">Предыдущая страница</a>
            <?php } ?>
        </div>

        <div class="mb-5">
            <?php
            $test_num = mysqli_query($db, "select id as test_id,text_id from tests where text_id = '{$id}'");
            $test_id = mysqli_fetch_assoc($test_num);
            if ($id ==$test_id['text_id']) {
                ?>
                <a href="test.php?id=<?php echo $test_id['test_id']; ?>" class="btn btn-primary">Пройти тест</a>
            <?php } elseif ($textId != $row_max['maxi']) { ?>
                <a href="paragr.php?id=<?php echo $row_next["min"]; ?>" class="btn btn-primary">Следующая страница</a>
            <?php } ?>
        </div>
    </div>
</div>
    <?php require "blocks/footer.php";?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>


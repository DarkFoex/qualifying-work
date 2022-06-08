<?php
$test_db = mysqli_connect('localhost', 'root', 'root', 'test', '3306');
$db = mysqli_connect('localhost', 'root', 'root', 'text_info', '3306');
session_start();
$id = (int)$_GET['id'];
if ($id < 1) {
    header('location: test_page.php');
}
    if ($_SESSION['user']['id'] == ''):
        $_SESSION['test'] = 'Для прохождения тестов войдите в аккаунт';
        header('Location: index.php');
endif;



$testId = $id;
if (!isset($_SESSION['test_id']) || $_SESSION['test_id'] != $testId ) {
    $_SESSION['test_id'] = $testId;
    $_SESSION['test_score'] = 0;
    $_SESSION['array'] = array();

}

$res = mysqli_query($test_db, "SELECT * FROM tests WHERE id = '{$testId}'");
$row = mysqli_fetch_assoc($res);
$testTitle = $row['title'];

$questionNum = (int)$_POST['q'];
if (empty($questionNum)) {
    $questionNum = 0;
}
$questionNum++;
$questionStart = $questionNum - 1;

$res = mysqli_query($test_db, "SELECT count(*) AS count FROM question WHERE test_id = '{$testId}'");
$row = mysqli_fetch_assoc($res);
$questionCount = $row['count'];
$answerId = (int)$_POST['answer_id'];
if (!empty($answerId)) {
    $res = mysqli_query($test_db, "SELECT * FROM answer WHERE id = '{$answerId}'");
    $row = mysqli_fetch_assoc($res);
    $score = $row['score'];
    $_SESSION['array'][$questionNum-1] = $score;
    $_SESSION['test_score'] += $score;
}
    
$showForm = 0;
if ($questionCount >= $questionNum) {
    $showForm = 1;

    $res = mysqli_query($test_db, "SELECT * FROM question WHERE test_id = '{$testId}' LIMIT {$questionStart}, 1");
    $row = mysqli_fetch_assoc($res);
    $question = $row['question'];
    $questionId = $row['id'];

    $res = mysqli_query($test_db, "SELECT * FROM answer WHERE question_id = '{$questionId}'");
    $answers = mysqli_fetch_all($res);
} else {
    $score = $_SESSION['test_score'];
    $res = mysqli_query($test_db, "SELECT * FROM results WHERE test_id = '{$testId}' AND score_min <= '{$score}' AND score_max >= '{$score}'");
    $row = mysqli_fetch_assoc($res);
    $result = $row['result'];
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Система тестирования</title>
    <link rel="shortcut icon" href="img/logo.svg" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    
</head>
<body>
<?php require "blocks/header.php"; 
?>
<div class="container">
    <?php if ($showForm) { ?>
        <form action="test.php?id=<?php echo $testId; ?>" method="post">
            <input type="hidden" name="q" value="<?php echo $questionNum; ?>">

            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3><?php echo $question; ?></h3>
                            <div class="text-center">
                        <p>Вопрос <?php echo $questionNum . ' из ' . $questionCount; ?></p>
                        <progress width=25px value="<?php echo $questionNum ?>" max="<?php echo  $questionCount; ?>"></progress>
                    </div>
                        </div>

                        <div class="card-body">
                            <?php foreach ($answers as $answer) { ?>
                                <div>
                                    <input type="radio" name="answer_id" required
                                           value="<?php echo $answer[0]; ?>"> <?php echo $answer[2]; ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <?php if ($questionCount == $questionNum) { ?>
                            <button type="submit" class="btn btn-success">Получить результат</button>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-primary">Дальше</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Ваш результат</h3>
                        <?php 
                                $user_id = $_SESSION['user']['id'];
                                $array_result = json_encode($_SESSION['array']);
                                $current_res = $_SESSION['test_score'];
                                $res_insert = mysqli_query($test_db,"INSERT IGNORE INTO user_result (`test_id`,`user_id`,`result`,`max_result`,`array_result`,`datetime_test`) VALUES ('$id','$user_id','$current_res','$questionCount','$array_result',DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 1 HOUR))");
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="result-print">
                            <p><?= $result ?></p>
                        </div>
                        <?php
                        $test_num = mysqli_query($test_db, "select id as test_id,text_id from tests where id = '{$id}'+1");
                        $test_id = mysqli_fetch_assoc($test_num);
                        $pg_id = $test_id['text_id'];
                        $text_num = mysqli_query($db, "select min(text_id) as min_id from text where title in (select distinct title from text where text_id ='{$pg_id}')");
                        $next_pg = mysqli_fetch_assoc($text_num);
                        $prev_page_id = mysqli_query($test_db, "select id as test_id,text_id from tests where id = '{$id}'");
                        $prev_id = mysqli_fetch_assoc($prev_page_id);
                        $min_text_id = $prev_id['text_id'];
                        $min_id = mysqli_query($db, "select min(text_id) as text_id from text where title in (select distinct title from text where text_id = '{$min_text_id}')");
                        $prev_text_id = mysqli_fetch_assoc($min_id);

                        ?>
                        <div class="d-flex justify-content-between">
                        <a href="paragr.php?id=<?php echo $prev_text_id['text_id']; ?>" class="btn btn-primary">Вернуться к изучению материала</a>
                        <a href="paragr.php?id=<?php echo $next_pg['min_id']; ?>" class="btn btn-primary">Следующая
                            глава</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php require "blocks/footer_lower.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
$db = mysqli_connect('localhost','root','root','test','3306');
session_start();
    $do = trim(strip_tags($_GET['do']));
    if ($do == 'save') {
        $title = trim($_POST['title']);
        print_r($_POST);
        $res1 = mysqli_query($db,"INSERT IGNORE INTO tests (`title`) VALUES ('$title')");
        $testId = mysqli_insert_id($db); # last insert
        print($testId);
        $question_Num = 1;
        while (isset($_POST['question_' . $question_Num])) {
            $question = trim($_POST['question_' . $question_Num]);
            if (empty($question)) {
                continue;
            }

            $res2 = mysqli_query($db,"INSERT IGNORE INTO question (`test_id`, `question`) VALUES ('$testId', '$question')");

            $questionId = mysqli_insert_id($db);
            print($questionId);
            $answerNum = 1;
            while (isset($_POST['answer_text_' . $question_Num . '_' . $answerNum])) {
                $answer = trim($_POST['answer_text_' . $question_Num . '_' . $answerNum]);
                $score = trim($_POST['answer_score_' . $question_Num . '_' . $answerNum]);
                if (empty($answer)) {
                    continue;
                }

                $res3 = mysqli_query($db,"INSERT IGNORE INTO answer (`question_id`, `answer`, `score`) 
                                    VALUES ('$questionId', '$answer', '$score')");


                $answerNum++;
            }
            $question_Num++;
        }

        $result_Num = 1;
        while (isset($_POST['result_' . $result_Num])) {
            $result = trim($_POST['result_' . $result_Num]);
            $scoreMin = trim($_POST['result_score_min_' . $result_Num]);
            $scoreMax = trim($_POST['result_score_max_' . $result_Num]);

            $res4 = mysqli_query($db,"INSERT IGNORE INTO results (`test_id`, `score_min`, `score_max`, `result`)
                                   VALUES ('$testId', '$scoreMin', '$scoreMax', '$result')");

            $result_Num++;
        }

        header ('Location: test_page.php?do=list');
    }

    if ($do != 'add') {
        $do = 'list';
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/font.css">
</head>
<body>

        <div class="row justify-content-center mx-auto ">

            <?php include_once 'inc/' . $do . '.php'; ?>

        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/test_add.js"></script>

</body>

</html>

<?php
$db = mysqli_connect('localhost','root','root','test','3306');
$text_db = mysqli_connect('localhost','root','root','text_info','3306');
$do = trim(strip_tags($_GET['do']));
if ($do == 'save') {
    $title = trim($_POST['title']);
    $sub_title = trim($_POST['$sub_title']);
    $id_res = mysqli_query($text_db,"SELECT id FROM text order by id desc limit 1");
    $text_num = mysqli_fetch_assoc($id_res)['id']+1;
    $id = 1;
while (isset($_POST['text_' . $id])) {
        $text = trim($_POST['text_'  . $id]);
        $img_type = substr($_FILES['img_' . $id]['type'], 0, 5);
        $img_size = 2*1024*1024;
        if(!empty($_FILES['img_' . $id]['tmp_name']) and $img_type === 'image' and $_FILES['img_' . $id]['size'] <= $img_size) {
            $img = addslashes(file_get_contents($_FILES['img_' . $id]['tmp_name']));
        }
    $res1 = mysqli_query($text_db, "INSERT IGNORE INTO text (`title`,`subtitle`,`text`,`text_id`,`image`) VALUES ('$title','$sub_title','$text','$text_num','$img')");
    $id++;
            //header('Location: course.php');
    }
        }
if ($do != 'add_text') {
    $do = 'list_text';
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

    <div class="row justify-content-center mx-auto">

        <?php include_once 'inc/' . $do . '.php'; ?>
        <?php $info = mysqli_query($text_db, "SELECT * FROM `text`; ");
        if( mysqli_num_rows($info) > 0){
            $text = mysqli_fetch_assoc($info);
            $_SESSION['text'] = [
                "id" => $text['id'],
                "text" => $text['text'],
                "image" => $text['image'],
                "text_id" => $text['text_id']
            ];
            //header('Location: index.php');
        }

        ?>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="js/text.js"></script>
</body>
</html>


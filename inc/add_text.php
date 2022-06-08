<?php
$db = mysqli_connect('localhost','root','root','test','3306');
$users = mysqli_connect('localhost','root','root','users','3306');
session_start();
if($_SESSION['user']['id'] == ''):
header('Location: index.php');
endif;
?>
<?php require "blocks/header_adm.php";?>
<div class="col-md-6">
    <form action="course.php?do=save" method="post" enctype="multipart/form-data">
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="text-center">Добавление текста</h2>
            </div>
            <div class="card-body">
                <div>
                    <label for="title" class="form-label">Название текста</label>
                    <input type="text" name="title" id="title" class="form-control">
                    <label for="title" class="form-label">Название главы</label>
                    <input type="text" name="$sub_title" id="$sub_title" class="form-control">
                </div>
                <div class="mt-5 text-center">
                    <h4>Добавление параграфов</h4>
                </div>
                <div class="questions">
                    <div class="para-items">
                        <div class="mt-4">
                            <label for="text_1" class="form-label">Параграф #1</label>
                            <input type="text" name="text_1" id="text_1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary addQuestion">Добавить параграф</button>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <h4>Добавление картинки</h4>
                </div>
                <div class="results">
                    <div class="result-items">
                        <div class="mt-4">
                            <div class="">
                                <label class="form-label" for="image_1">Изображение #1</label>
                                <input type="file" name="img_1">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary addPic" >Добавить картинку</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 mb-4">
            <div class="card-body text-center">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </div>
    </form>
</div>
<?php require "blocks/footer.php";?>
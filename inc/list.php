<?php
$db = mysqli_connect('localhost','root','root','test','3306');
$users = mysqli_connect('localhost','root','root','users','3306');
if ($_SESSION['user']['id'] == ''){
        $_SESSION['test'] = 'Для прохождения тестов войдите в аккаунт';
        header('Location: index.php');
}
?>
<?php require "blocks/header.php";?>
<div class="container">
    <div class="">
        <div class="">
            <h2 class="text-center">Список тестов</h2>

        </div>
    <div class="d-flex row">
    <?php
    $res = mysqli_query($db,"SELECT * FROM `tests`");
    while ($row = mysqli_fetch_assoc($res)) {
    ?>

        <div class="col ps-0 pe-0">
        <div class=" mx-auto w-50 text-center-6 mb-0 box-shadow ">

            <div class="  mb-5 shadow p-3  bg-body rounded border-top border-success ">


                <a class="link-dark d-flex text-decoration-none ms-3" href="test.php?id=<?php echo $row['id']; ?>"><img class="me-5" src="img/test.svg"  height="25" alt="image format png" /><h5><?php echo $row['title']; ?></h5></a>



            </div>
        </div>
    <?php } ?>
    </div>
    </div>

    <?php unset($_SESSION['test_score']); 
        unset($_SESSION['array']);?>
</div>
<?php require "blocks/footer.php";?>
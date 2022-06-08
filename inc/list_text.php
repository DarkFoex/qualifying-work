<?php
$db = mysqli_connect('localhost', 'root', 'root', 'test', '3306');
$users = mysqli_connect('localhost', 'root', 'root', 'users', '3306');
$text_db = mysqli_connect('localhost', 'root', 'root', 'text_info', '3306');
session_start();

?>
<?php require "blocks/header.php"; ?>
<div class="container">

    <div class="d-flex row">
        <?php
        $prev_title = '';
        $res = mysqli_query($text_db, "SELECT DISTINCT A.text_id from text A; ; ");
        while ($row = mysqli_fetch_assoc($res)) {
        $text_id = $row['text_id'];
        $res_by_text_id = mysqli_query($text_db, "SELECT * from text A where text_id = '$text_id'  ; ");
        $row2 = mysqli_fetch_assoc($res_by_text_id);
        ?>
        <div class="col ">
            <div class=" mx-auto w-50 text-center-6 mb-0 box-shadow ">
                <div class="  mb-3  ">
                    <h4><?php
                        if ($prev_title != $row2['title']) { ?>
                            <div class="card-header ">
                                <?php echo $row2['title']; ?>
                            </div>
                            <?php $prev_title = $row2['title'];
                        } ?></h4>
                    <div class="card-text ms-5">
                        <a class="link-dark d-flex text-decoration-none ms-1"
                           href="paragr.php?id=<?php echo $row2['text_id']; ?> "><img class="me-2" src="img/test.svg"
                                                                                      height="25"
                                                                                      alt="image format png"/>
                            <h5><?php if (strlen($row2['subtitle']) > 1) {echo $row2['subtitle'];} ?></h5>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php unset($_SESSION['test_score']); ?>
</div>
<?php require "blocks/footer.php"; ?>

<?php
    session_start();
?>
<!-- header start -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <header class="p-3 text-white" style="background-color: #014530;">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start ">
          <div class="d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto">
          <a href=/ class="">
              <img src="img/logo.svg" height="70" alt="Электронный учебник 'Защита декоративных растений рекреационных зон г. Нур-Султан" />
          </a>
              <p class="ms-5 me-lg-auto mb-0 w-60">Электронный учебник <br><b>Защита декоративных растений рекреационных зон г. Нур-Султан</b></p>
          </div>




        <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>  -->


        <div class="text-end">
          <?php

            if($_SESSION['user']['id'] != ''):
          ?>


                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".dropdown-toggle-js").dropdown();
                    });
                </script>

                <div class="dropdown">
                    <a href="#" class="dropdown-toggle-js" data-toggle="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #DDA708;">
                            <?= $_SESSION['user']['fullname']?>
                        </button>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php" class="dropdown-item">Учебник</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php" class="dropdown-item">Выйти</a></li>
                    </ul>
                </div>
          <?php else: ?>
            <a type="button" class="btn btn-outline-light me-2" href ="/login.php">Войти</a>
          <?php endif; ?>

            <?php
            if($_SESSION['user']['id'] == ''):
            ?>
            <a type="button" class="btn btn-warning" href ="/register.php">Регистрация</a>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--   header end -->
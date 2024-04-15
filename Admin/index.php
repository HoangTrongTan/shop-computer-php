<?php include_once("header.php");  ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php echo '<br>Tên đăng nhập: '.$_SESSION['user'][0].' </br>'?>
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">quản trị </h1>

    </div>
    <!-- /.container-fluid -->

<?php include_once("footer.php");  ?>



<!-- <?php
     if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
?> -->
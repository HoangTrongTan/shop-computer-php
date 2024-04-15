<?php
     if(!isset($_SESSION['user'])){        
        echo "Không tồn tại ";
        echo"<script> window.location.href='login.php';</script>";
      // header("location: index.php");

     }else{
      echo "có tồn tại";
      unset($_SESSION['user']);
      // echo"<script> window.location.href='login.php';</script>";
      // header("location: login.php");
     }
      
      
?>
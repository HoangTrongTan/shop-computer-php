<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['customer'])){
        echo 'không tồn tại';
        echo "<script>window.location.href='login_user.php'</script>";
    }else{
        unset($_SESSION['customer']);
        unset($_SESSION['taikhoan_user']);
        echo "<script>alert('đã thoát ra rùi :>') </script>";
        echo "<script>window.location.href='index.php' </script>";
    }
?>
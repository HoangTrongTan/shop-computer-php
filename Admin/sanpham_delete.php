<?php
    include_once("../class/database.class.php");
    $db = new Database();
    $masp = $_GET['key'];
    echo $masp;
    $sql = "DELETE FROM `sanpham` WHERE masp = '$masp'";
    $check = $db->thucthi($sql);
    $sql1 = "DELETE FROM `images` WHERE masp = '$masp'";
    if($check){
        echo "<script>alert('xóa thành công'); </script>";
    }
    echo "<script> window.location.href='sanpham.php' </script>";
?>
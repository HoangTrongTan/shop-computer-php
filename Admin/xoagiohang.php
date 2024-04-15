<?php
    include_once("header.php");
    $magiohang = isset($_GET['magiohang']) ? $_GET['magiohang']:'';
    $check = $db->thucthi("UPDATE `dathang` SET `trangthai` = 1 WHERE `magiohang` = $magiohang");
    // $check = $db->thucthi("DELETE FROM `dathang` WHERE magiohang = '$magiohang'");
    if(!$check){
        echo 'loi';
    }else{
        echo "<script>window.location.href='danhsachdathang.php'</script>";
    }
?>
<?php
    include_once("header.php");
    $magiohang = isset($_GET['magiohang']) ? $_GET['magiohang']: '';
    $result = $db->thucthi("SELECT masp,soluong FROM `dathang` WHERE magiohang = '$magiohang'");
    $ketqua = mysqli_fetch_array($result);
    $ketqua_masp = explode('-', $ketqua['masp']);
    $ketqua_soluong = explode('-', $ketqua['soluong']);
    // echo count($ketqua_masp);
    for($i = 1; $i < count($ketqua_masp); $i ++){
        $db->thucthi("UPDATE `sanpham` SET `soluong`= ((SELECT soluong FROM `sanpham` WHERE masp = $ketqua_masp[$i]) + $ketqua_soluong[$i]) WHERE masp = $ketqua_masp[$i]");
    }

    $check = $db->thucthi("DELETE FROM `dathang` WHERE magiohang = '$magiohang' ");
    if(!$check){
        echo 'loi';
    }else{
        // $db->thucthi("DELETE FROM `order`");
        echo "<script>alert('hủy thành cônng')</script>";
        echo "<script>window.location.href='hangcho.php'</script>";
    }
?>